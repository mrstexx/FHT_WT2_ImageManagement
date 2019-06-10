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
        success: onSuccess,
        error: function () {
            alert("Upload error occured.");
        }
    });
});

function onSuccess(response) {
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
                '                     alt="' + allImages[i].name + '">\n' +
                '                <div class="img-options">\n' +
                '                   <i class="fas fa-share-square"></i>\n' +
                '                   <i class="fas fa-hashtag"></i>\n' +
                '                   <i class="fas fa-copy"></i>\n' +
                '                   <i class="fas fa-trash"></i>\n' +
                '                </div>\n' +
                '              </div>\n';
        }
        imagesTemp += '</div>';
        imagesEl.append(imagesTemp);
    }
}