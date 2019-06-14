<?php

session_start();
include("../model/Image.php");
include("../model/Database.php");

if (isset($_POST["id"]) && isset($_POST["action"])) {
    $retObj = new stdClass();
    $imageID = $_POST["id"];
    $imageAction = $_POST["action"];
    $userName = $_SESSION["user"];

    switch ($imageAction) {
        case "copy_image":
            $retObj->success = Image::copyImage($imageID, $userName);
            break;
        case "delete_image":
            Image::deleteImage($imageID, $userName);
            $retObj->success = Image::getAllUserImages($userName);
            break;
    }

    echo json_encode($retObj);
}

?>