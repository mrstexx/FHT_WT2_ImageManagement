<?php
include "actions/Login.php";
include "actions/Registration.php";

$loggedUser = "";
$isAdmin = null;

if (isset($_SESSION["user"])) {
    $loggedUser = $_SESSION["user"];
    $isAdmin = User::isUserAdmin($loggedUser);
}

?>
<?php
include "inc/header.php";
?>
<?php
include "inc/navigation.php";
?>

<?php
if (isset($_GET["page"])) {
    $pageName = $_GET["page"];
    if ($pageName != "") {
        include "inc/" . $pageName . ".php";
    } else {
        include "inc/home.php";
    }
} else {
    include "inc/home.php";
}
?>

<?php
include "inc/footer.php";
?>