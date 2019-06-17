<?php
$navigation = null;
$xmlData = simplexml_load_file("config/navigation.xml");
if (isset($isAdmin)) {
    if ($isAdmin) {
        $navigation = $xmlData->admin;
    } else {
        $navigation = $xmlData->user;
    }
} else {
    $navigation = $xmlData->anonym;
}

function createNavbarItem($pageTitle, $pageName)
{
    return "<li class=\"nav-item " . setActiveNavbar($pageName) . "\">
                <a class=\"nav-link\" href=\"?page=" . $pageName . "\"><i class=\"fas fa-" . getIcon($pageName) .
        "\"></i> " . $pageTitle . "</a>   
        </li>";
}

function getIcon($pageName)
{
    switch ($pageName[0]) {
        case "home":
            return "home";
        case "help":
            return "info-circle";
        case "feed":
            return "images";
        case "manager":
            return "cogs";
        case "useraccount":
            return "user-cog";
        case "userdata":
            return "user-cog";
    }
    return "";
}

function setActiveNavbar($pageName)
{
    $temp = $pageName[0]->__toString();
    if (strpos($_SERVER["REQUEST_URI"], $temp)) {
        return "active";
    } else if (!strpos($_SERVER["REQUEST_URI"], "page") && $temp == "home") {
        return "active";
    }
    return "";
}

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="?page=home">
        <img class="navbar-logo" src="res/img/fav-logo.png" alt="Logo image">
        Image Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            for ($i = 0; $i < sizeof($navigation->section); $i++) {
                echo createNavbarItem($navigation->section[$i][0], $navigation->section[$i][0]->attributes()[0]);
            }
            ?>
        </ul>
        <?php
        if ($isAdmin != null || $loggedUser != "") {
            echo "<div id='logged_div'>Logged as: " . $_SESSION["user"] . "</div>";
            echo '<form class="form" role="" action="" method="POST">
                        <button class="btn btn-outline-secondary" type="submit" name="buttonlogout" value=""><i class="fas fa-sign-out-alt"></i></button>
                  </form>';
        } else {
            echo "<form id=\"login_form\" class=\"form-inline my-2 my-lg-0\" role=\"form\" action=\"\" method=\"POST\">
                    <input id=\"tooltip_user\" type=\"\" data-toggle=\"tooltip\" data-placement=\"bottom\"
                        title=\"Input your username or email\" class=\"form-control form-control-sm mr-sm-2 test\"
                         name=\"login_name\" placeholder=\"Email or username\" required>
                    <input data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Input your password\"
                        class=\"form-control form-control-sm mr-sm-2\" type=\"password\" name=\"login_pw\" placeholder=\"Password\"
                        aria-label=\"password\" required>
                        <input class=\"form-check-input\" type=\"checkbox\" name=\"checklogin\" value=\"ja\"
                        id=\"defaultCheck1\">
                     <label id=\"checklog\" class=\"form-check-label\" for=\"defaultCheck1\">
                     Stay logged in?
                     </label>
                    <button class=\"btn btn-sm btn-outline-dark my-2 my-sm-0\" type=\"submit\">Login <i
                        class=\"fas fa-sign-in-alt\"></i></button>
                </form>";
        }
        ?>

    </div>
</nav>