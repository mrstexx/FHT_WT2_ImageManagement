<?php

session_start();
include("../model/Image.php");
include("../model/Database.php");

if (isset($_POST["id"]) && isset($_POST["action"])) {
    $retObj = new stdClass();
    $imageID = $_POST["id"];
    $imageAction = $_POST["action"];
    $tags = null;
    if (isset($_POST["tags"])) {
        $tags = $_POST["tags"];
    }
    switch ($imageAction) {
        case "getTags":
            $retObj->success = Image::getTags($imageID);
            break;
        case "updateTags":
            $retObj->success = Image::updateTags($imageID, $tags);
            break;
    }

    echo json_encode($retObj);
}
?>