<?php
include "model/Image.php";
?>

<h1 class="mt-4">
    <button class="btn btn-secondary" id="menu-toggle"><i class="fas fa-exchange-alt"></i></button>
    Crop image
</h1>
<div class="form-group">
    <label for="cropImageSelect">Choose image and select area to be cropped</label>
    <select class="form-control" id="cropImageSelect">
        <?php
        $userImages = Image::getAllUserImages($_SESSION["user"]);
        for ($i = 0; $i < sizeof($userImages); $i++) {
            echo "<option>" . $userImages[$i]["name"] . "</option>";
        }
        ?>
    </select>
    <div class="selected-crop-image">
        <img id='cropbox' class='img-fluid selected-image'
             src='pictures/full/<?php echo $userImages[0]["name"] ?>'/>
    </div>
</div>


