<?php

session_start();
include("../model/Image.php");
include("../model/Database.php");

if (isset($_POST["id"]) && isset($_POST["action"])) {
    $retObj = new stdClass();
    $imageID = $_POST["id"];
    $imageAction = $_POST["action"];
    $selectedUsers = null;
    $loggedUser = $_SESSION["user"];
    if (isset($_POST["selected"])) {
        $selectedUsers = $_POST["selected"];
    }
    switch ($imageAction) {
        case "getUsersSelection":
            $retObj->success = Image::getUsersSelection($imageID, $loggedUser);
            break;
        case "updateSelectedUsers":
            $retObj->success = Image::updateUserImageSelection($imageID, $selectedUsers, $loggedUser);
            break;
    }

    echo json_encode($retObj);
}
?>