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