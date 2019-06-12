var currentTags = [];
var imageID = "";

$(document).on("click", ".mng-tag", function (e) {
    $(".tag-list").empty();
    if ($(this).parent().parent().children().first()) {
        imageID = $(this).parent().parent().children().first()[0].id;
    }
    $('#taggingModel').modal('show');
    sendAction("getTags", imageID, currentTags);
});

function sendAction(actionType, imgID, listOfTags) {
    if (listOfTags !== null) {
        $.ajax({
            type: "POST",
            url: "./actions/TagControl.php",
            data: {
                action: actionType,
                id: imgID,
                tags: listOfTags
            },
            success: function (response) {
                var payload = JSON.parse(response);
                currentTags = payload.success;
                if (actionType === "updateTags") {
                    $('#taggingModel').modal('toggle');
                    return;
                }
                renderAllTags();
            }
        });
    }
}

$(document).on("click", ".tag", function (e) {
    var tagName = this.innerText;
    currentTags = currentTags.filter(function (tag) {
        return tag !== tagName;
    });
    renderAllTags();
});

$(".tag-input").on('keypress', function (e) {
    var tagInputEl = $(".tag-input");
    if (e.which === 13) {
        var tagName = tagInputEl.val();
        addNewTag(tagName);
        tagInputEl.val("");
        renderAllTags();
    }
});

$(".tag-save").on("click", function (e) {
    sendAction("updateTags", imageID, currentTags);
});

function renderAllTags() {
    var tagListEl = $(".tag-list");
    tagListEl.empty();
    if (currentTags !== null) {
        for (var i = 0; i < currentTags.length; i++) {
            tagListEl.append('<span class="badge badge-pill badge-info tag">' + currentTags[i]
                + '<i class="fas fa-times-circle tag-remove-icon"></i></span>');
        }
    } else {
        currentTags = [];
    }
}

function addNewTag(tagName) {
    if (currentTags !== null) {
        if (!currentTags.includes(tagName) && tagName !== "") {
            currentTags.push(tagName);
        }
    } else {
        currentTags = [];
    }
}