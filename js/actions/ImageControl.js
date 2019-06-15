$(document).on("click", ".mng-delete", function (e) {
    var imgID = "";
    if ($(this).parent().parent().children().first()) {
        imgID = $(this).parent().parent().children().first()[0].id;
    }
    sendRequest(imgID, "delete_image");
});

$(document).on("click", ".mng-copy", function (e) {
    var imgID = "";
    if ($(this).parent().parent().children().first()) {
        imgID = $(this).parent().parent().children().first()[0].id;
    }
    sendRequest(imgID, "copy_image");
});

function sendRequest(imgID, action) {
    $.ajax({
        type: "POST",
        url: "./actions/ImageControl.php",
        data: {
            action: action,
            id: imgID
        },
        success: onSuccessRenderImages
    });
}

var size = {};
var selectedImage = "";
var selectedImageID = "";

$("#cropImageSelect").on("change", function () {
    selectedImage = this.value;
    selectedImageID = $(this).children(":selected").attr("id");
    var selectArea = $(".selected-crop-image");
    selectArea.empty();
    if (selectedImage !== "Not selected") {
        selectArea.prepend("<img id='cropbox' class='img-fluid selected-image'\n" +
            "             src=''/>");
        $("#cropbox").attr("src", "pictures/full/" + selectedImage);
        $("#cropbox").Jcrop({
            boxWidth: 500,
            onSelect: function (c) {
                size = {
                    x: c.x,
                    y: c.y,
                    w: c.w,
                    h: c.h
                };
            }
        });
    }
});

$(".crop-btn").click(function () {
    $.ajax({
        type: "POST",
        url: "./actions/ImageControl.php",
        data: {
            action: "crop_image",
            id: selectedImageID,
            imageName: selectedImage,
            x: size.x,
            y: size.y,
            w: size.w,
            h: size.h
        },
        success: function (response) {
            location.reload();
        }
    });
});