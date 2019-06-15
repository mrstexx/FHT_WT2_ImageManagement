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
        echo "<h6 class='text-center'>" . $images[$i]["name"] . "</h6>";
        echo "<div class=\"img-options\">";
        echo "<i class=\"fas fa-share-square mng-share\"></i>
            <i class=\"fas fa-hashtag mng-tag\"></i>
            <i class=\"fas fa-copy mng-copy\"></i>
            <i class=\"fas fa-trash mng-delete\"></i>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>"
    ?>
</div>

<!-- Tagging Modal -->
<div class="modal fade" id="taggingModel" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Add/Remove image tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body tag-body">
                <div class="form-group">
                    <input type="text" class="form-control tag-input" placeholder="Add new tag">
                </div>
                <div class="tag-list">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary tag-save">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Sharring Modal -->
<div class="modal fade" id="sharingModel" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Share image with</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body share-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" class="share-check">
                        </div>
                    </div>
                    <input type="text" class="form-control" value="Some text" readonly>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" class="share-check">
                        </div>
                    </div>
                    <input type="text" class="form-control" value="lalalal" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary share-save">Save changes</button>
            </div>
        </div>
    </div>
</div>