<?php
include "model/Image.php";
?>

<h1 class="mt-4">
    <button class="btn btn-secondary" id="menu-toggle"><i class="fas fa-exchange-alt"></i></button>
    Add Geo-position
</h1>
<h5>Select below image and drag to map</h5>

<div id="map"></div>

<div class="my-images">
    <?php
    $userImages = Image::getAllUserImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($userImages); $i++) {
        echo "<img class='geo-image' src='" . $userImages[$i]["thumbnail_directory"] . "'>";
    }
    ?>
</div>
<button class="btn btn-info">Save changes</button>