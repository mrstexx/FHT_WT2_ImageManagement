<?php

class Image
{
    private $imageName;
    private $date;
    private $directory;
    private $thumbDir;
    private $geoInfo;
    private $owner;

    public function __construct($owner, $imageName, $directory, $thumbDir, $geoInfo)
    {
        $this->owner = $owner;
        $this->imageName = $imageName;
        $this->directory = $directory;
        $this->thumbDir = $thumbDir;
        $this->geoInfo = $geoInfo;
    }

    public static function saveThumbImage($imagePath, $w, $h)
    {
        $sourceUrl = pathinfo($imagePath);
        $fileName = $sourceUrl['filename'];
        $extension = $sourceUrl['extension'];

        list($width, $height) = getimagesize($imagePath);
        $r = $width / $height;
        if ($w / $h > $r) {
            $newWidth = $h * $r;
            $newHeight = $h;
        } else {
            $newHeight = $w / $r;
            $newWidth = $w;
        }

        $src = Image::getSourceFromImageExtension($extension, $imagePath);

        $layer = imagecreatetruecolor($newWidth, $newHeight);
        $newFileName = "pictures/thumbnail/" . $fileName . ".jpg";
        imagecopyresampled($layer, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagejpeg($layer, "../" . $newFileName);
        imagedestroy($layer);
        return $newFileName;
    }

    public static function getSourceFromImageExtension($extension, $imagePath)
    {
        switch ($extension) {
            case "png":
                $src = imagecreatefrompng($imagePath);
                break;
            case "jpeg":
            case "jpg":
                $src = imagecreatefromjpeg($imagePath);
                break;
            case "gif":
                $src = imagecreatefromgif($imagePath);
                break;
            default:
                $src = imagecreatefromjpeg($imagePath);
                break;
        }
        return $src;
    }

    public function addNewImage()
    {
        $db = new Database();
        if ($db->connect()) {
            $result = $db->addNewImage($this->owner, $this->imageName, $this->directory, $this->thumbDir, $this->geoInfo);
            $db->close_con();
            return $result;
        }
        return false;
    }

    public static function getAllUserImages($userName)
    {
        $db = new Database();
        if ($db->connect()) {
            $result = $db->fetchAllUserImages($userName);
            $db->close_con();
            return $result;
        }
        $db->close_con();
        return null;
    }

    public static function isImageExisting($imageName)
    {
        $db = new Database();
        if ($db->connect()) {
            $result = $db->checkImageName($imageName);
            if ($result) {
                $db->close_con();
                return true;
            }
        }
        $db->close_con();
        return false;
    }

    public static function copyImage($imageID, $userName)
    {
        $dir = "";
        $thumbDir = "";
        $db = new Database();
        if ($db->connect()) {
            $result = $db->getImageData($imageID);
            if ($result) {
                $imageName = $result["name"];
                $dir = $result["directory"];
                $pathInfo = pathInfo($dir);
                $newDir = "../pictures/full/" . $pathInfo['filename'] . "-dupl." . $pathInfo['extension'];
                copy($dir, $newDir);
                $thumbDir = Image::saveThumbImage($newDir, 400, 350);
                $image = new Image($userName, $imageName, $newDir, $thumbDir, $result["geoinfo"]);
                if ($image->addNewImage()) {
                    $db->close_con();
                    return Image::getAllUserImages($userName);
                }
            }
        }
        $db->close_con();
        return null;
    }

    public static function deleteImage($imageID, $userName)
    {
        $db = new Database();
        if ($db->connect()) {
            $imgDirs = $db->getImageData($imageID);
            $db->deleteImage($imageID);
            // delete files from directories
            if (file_exists($imgDirs["directory"])) {
                unlink($imgDirs["directory"]);
            }
            if (file_exists("../" . $imgDirs["thumbnail_directory"])) {
                unlink("../" . $imgDirs["thumbnail_directory"]);
            }
        }
        $db->close_con();
        return Image::getAllUserImages($userName);
    }

    public static function getTags($imageID)
    {
        $db = new Database();
        if ($db->connect()) {
            $result = $db->getUserTags($imageID);
            if ($result) {
                $db->close_con();
                return $result;
            }
        }
        $db->close_con();
        return array();
    }

    public static function updateTags($imageID, $tags)
    {
        $existingTags = Image::getTags($imageID);
        $tagsToAdd = array();
        $tagsToDelete = array();
        if ($tags != null) {
            foreach ($tags as $newTag) {
                if (!in_array($newTag, $existingTags)) {
                    array_push($tagsToAdd, $newTag);
                }
            }
            foreach ($existingTags as $tag) {
                if (!in_array($tag, $tagsToAdd) && !in_array($tag, $tags)) {
                    array_push($tagsToDelete, $tag);
                }
            }
        } else {
            foreach ($existingTags as $tag) {
                array_push($tagsToDelete, $tag);
            }
        }

        $db = new Database();
        if ($db->connect()) {
            for ($i = 0; $i < sizeof($tagsToAdd); $i++) {
                $db->addNewTag($tagsToAdd[$i]);
                $db->addTagToImage($imageID, $tagsToAdd[$i]);
            }
            for ($i = 0; $i < sizeof($tagsToDelete); $i++) {
                $db->deleteTag($imageID, $tagsToDelete[$i]);
            }
        }
        $db->close_con();
        return Image::getTags($imageID);
    }
}
