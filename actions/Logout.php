<?php
    if (isset($_POST["buttonlogout"])) {
        session_destroy();
        session_unset();
        unset($_SESSION["user"]);
        $_SESSION = array();
        if(isset($_COOKIE['userstay'])){
        unset($_COOKIE["userstay"]);
        setcookie("userstay", '', time() - 1, '/', 'localhost');
        }
        header("Location:index.php"); 
    }
?>