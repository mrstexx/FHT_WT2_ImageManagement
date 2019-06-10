<?php
session_start();
include("../model/Image.php");
include("../model/Database.php");

if (isset($_FILES)) {
    $fileType = $_FILES['file']['type'];
    $allowedTypes = array("image/jpeg", "image/gif", "image/png");
    $fileUpload = $_FILES["file"];
    $retObj = new stdClass();
    if (!in_array($fileType, $allowedTypes)) {
        $retObj->error = true;
        $retObj->errorMessage = "Not supported file format.";
    } else if (!$fileUpload['error'] &&
        $fileUpload['size'] > 0 &&
        $fileUpload['tmp_name'] &&
        is_uploaded_file($fileUpload['tmp_name'])) {

        $userName = $_SESSION["user"];
        $imageName = $fileUpload["name"];
        $dir = "../pictures/full/" . $imageName;
        move_uploaded_file($fileUpload['tmp_name'], $dir);
        $thumbDir = Image::saveThumbImage($dir, 400, 350);

        $image = new Image($userName, $imageName, $dir, $thumbDir, "");
        if ($image->addNewImage()) {
            $retObj->error = false;
            $retObj->success = Image::getAllUserImages($userName);
        } else {
            $retObj->error = true;
            $retObj->errorMessage = "An error occurred. Please try again.";
        }
    } else {
        $retObj->error = true;
        $retObj->errorMessage = "An error occured. Please try again";
    }
    echo json_encode($retObj);
}
?>