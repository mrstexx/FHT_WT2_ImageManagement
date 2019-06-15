var allUserImages = [];

$(".choose-file-btn").change(function () {
        if ($(this).val()) {
            $("#uploadBtnSubmit").attr("disabled", false);
        } else {
            $("#uploadBtnSubmit").attr("disabled", true);
        }
    }
);

$("#newImage").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
        url: "./actions/NewImage.php",
        enctype: 'multipart/form-data',
        type: "POST",
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: onSuccessRenderImages,
        error: function () {
            alert("Upload error occured.");
        }
    });
});

function onSuccessRenderImages(response) {
    var imagesEl = $("#myImages");
    imagesEl.empty();
    var payload = JSON.parse(response);
    if (payload.error) {
        alert(payload.error_message);
    } else {
        var allImages = payload.success;
        this.allUserImages = allImages;
        //imagesEl.append("<div class='row'>");
        var imagesTemp = "<div class='row'>";
        for (var i = 0; i < allImages.length; i++) {
            imagesTemp += '<div class="col-md-6 col-lg-3 my-image">\n' +
                '                <img src="' + allImages[i].thumbnail_directory + '"\n' +
                '                     class="img-fluid"\n' +
                '                     id="' + allImages[i].pk_bild_id + '"\n' +
                '                     alt="' + allImages[i].name + '">\n' +
                '                 <h6 class="text-center">' + allImages[i].name + '</h6>' +
                '                <div class="img-options">\n' +
                '                   <i class="fas fa-share-square mng-share"></i>\n' +
                '                   <i class="fas fa-hashtag mng-tag"></i>\n' +
                '                   <i class="fas fa-copy mng-copy"></i>\n' +
                '                   <i class="fas fa-trash mng-delete"></i>\n' +
                '                </div>\n' +
                '              </div>\n';
        }
        imagesTemp += '</div>';
        imagesEl.append(imagesTemp);
    }
}