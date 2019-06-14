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

$("#cropImageSelect").on("change", function () {
    var selectedImage = this.value;
    var selectArea = $(".selected-crop-image");
    selectArea.empty();
    $(".selected-image").attr("src", "pictures/full/" + selectedImage);
    $(".selected-crop-image").load(" .selected-crop-image > *");
});

var size = {};
$("#cropbox").Jcrop({
    onSelect: function (c) {
        size = {
            x: c.x,
            y: c.y,
            w: c.w,
            h: c.h
        };
        // $("#crop").css("visibility", "visible");
    }
});