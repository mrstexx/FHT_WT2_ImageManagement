<?php
function setActiveSubPage($pageName)
{
    if (isset($_GET["manager"])) {
        $currentSubpageName = $_GET["manager"];
        if ($currentSubpageName == $pageName) {
            return "subpage-active";
        }
    }
    return "";
}

function setSubpageLink($pageName)
{
    $mainPage = $_GET["page"];
    if (strpos($_SERVER["REQUEST_URI"], "&manager=") != false) {
        $newPageName = $_SERVER["PHP_SELF"] . "?page=" . $mainPage . "&manager=" . $pageName;
        return $newPageName;
    }
    return $_SERVER["REQUEST_URI"] . "&manager=" . $pageName;
}

?>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Image Controls</div>
        <div class="list-group list-group-flush">
            <a href="<?php echo setSubpageLink("addNewImage"); ?>"
               class="list-group-item list-group-item-action bg-light <?php echo isset($_GET["manager"]) ? setActiveSubPage("addNewImage") : "subpage-active"; ?>"><i
                        class="fas fa-plus-circle"></i> Add
                new image</a>
            <a href="<?php echo setSubpageLink("cropImage"); ?>"
               class="list-group-item list-group-item-action bg-light <?php echo setActiveSubPage("cropImage") ?>"><i
                        class="fas fa-crop"></i> Crop images</a>
            <a href="<?php echo setSubpageLink("geoPosition"); ?>"
               class="list-group-item list-group-item-action bg-light <?php echo setActiveSubPage("geoPosition") ?>"><i
                        class="fas fa-map-marked-alt"></i>
                Geo Position</a>
        </div>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <?php
            if (isset($_GET["manager"])) {
                $subpageName = $_GET["manager"];
                if ($subpageName != "") {
                    include "inc/" . $subpageName . ".php";
                } else {
                    include "inc/addNewImage.php";
                }
            } else {
                include "inc/addNewImage.php";
            }
            ?>
        </div>
    </div>
</div>

<script src="js/ManagerHelper.js"></script>
<script src="./js/actions/NewImage.js"></script>
<script src="./js/actions/ImageControl.js"></script>
<script src="./js/actions/TaggingHandler.js"></script>
<script src="./js/actions/SharingHandler.js"></script>