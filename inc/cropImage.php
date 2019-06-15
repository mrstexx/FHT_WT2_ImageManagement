<?php
include "model/Image.php";
?>

<h1 class="mt-4">
    <button class="btn btn-secondary" id="menu-toggle"><i class="fas fa-exchange-alt"></i></button>
    Crop image
</h1>
<div class="form-group">
    <label for="cropImageSelect">Choose image and select area to be cropped</label>
    <div class="row">
        <div class="col-md-10">
            <select class="form-control" id="cropImageSelect">
                <option>Not selected</option>
                <?php
                $userImages = Image::getAllUserImages($_SESSION["user"]);
                for ($i = 0; $i < sizeof($userImages); $i++) {
                    echo "<option id='" . $userImages[$i]['pk_bild_id'] . "'>" . $userImages[$i]["name"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-2">
            <button class="crop-btn btn btn-primary btn-block">Crop</button>
        </div>
    </div>
    <div class="selected-crop-image">
    </div>
</div>


