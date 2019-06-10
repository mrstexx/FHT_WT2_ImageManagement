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

    public function getAllUserImages($userName)
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
}