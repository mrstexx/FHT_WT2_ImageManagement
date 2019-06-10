<?php
include "model/Image.php";
?>

<h1 class="mt-4">
    <button class="btn btn-secondary" id="menu-toggle"><i class="fas fa-exchange-alt"></i></button>
    Add new image
</h1>
<br>
<h5>Select new image</h5>
<div id="selectImage">
    <form id="newImage" enctype="multipart/form-data">
        <button type="submit" id="uploadBtnSubmit" class="btn btn-primary btn-sm" disabled>
            <i class="fas fa-plus-circle"></i> Add
        </button>
        <input name="file" type="file" accept="image/gif, image/png, image/jpeg" class="choose-file-btn">
    </form>
</div>
<br>
<h5>List of my images</h5>
<div id="myImages">
    <?php
    echo "<div class=\"row\">";
    $images = Image::getAllUserImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($images); $i++) {
        echo "<div class=\"col-md-6 col-lg-3 my-image\">";
        echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\">";
        echo "<div class=\"img-options\">";
        echo "<i class=\"fas fa-share-square\"></i>
            <i class=\"fas fa-hashtag\"></i>
            <i class=\"fas fa-copy mng-copy\"></i>
            <i class=\"fas fa-trash mng-delete\"></i>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>"
    ?>
</div>