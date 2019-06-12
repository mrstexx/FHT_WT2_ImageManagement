var selectedUsers = [];
var imageID = "";

$(document).on("click", ".mng-share", function (e) {
    $(".share-body").empty();
    if ($(this).parent().parent().children().first()) {
        imageID = $(this).parent().parent().children().first()[0].id;
    }
    $('#sharingModel').modal('show');
    sendSharingAction("getUsersSelection", imageID);
});

$(".share-save").on("click", function (e) {
    sendSharingAction("updateSelectedUsers", imageID);
});

$(document).on("change", ".share-check", function () {
    var parentEl = $(this).parent().parent().parent();
    var userID = parentEl.children()[1].value;
    doCheckUncheck(this.checked, userID);
});

function doCheckUncheck(isChecked, userID) {
    if (isChecked) {
        if (!selectedUsers.includes(userID)) {
            selectedUsers.push(userID);
        }
    } else {
        selectedUsers = selectedUsers.filter(function (selectedUser) {
            return selectedUser !== userID;
        });
    }
    console.log(selectedUsers);
}

function sendSharingAction(actionType, imageID) {
    if (selectedUsers !== null) {
        $.ajax({
            type: "POST",
            url: "./actions/ShareControl.php",
            data: {
                action: actionType,
                id: imageID,
                selected: selectedUsers
            },
            success: function (response) {
                if (actionType === "updateSelectedUsers") {
                    $('#sharingModel').modal('toggle');
                    return;
                }
                var shareBodyEl = $(".share-body");
                shareBodyEl.empty();
                var payload = JSON.parse(response);
                selectedUsers = [];
                var result = payload.success;
                if (result !== null) {
                    for (var user in result) {
                        if (actionType === "getUsersSelection" && result[user]) {
                            selectedUsers.push(user);
                        }
                        var isSelected = result[user] ? "checked" : "";
                        shareBodyEl.append("<div class=\"input-group mb-3\">\n" +
                            "                    <div class=\"input-group-prepend\">\n" +
                            "                        <div class=\"input-group-text\">\n" +
                            "                            <input type=\"checkbox\" class=\"share-check\" " + isSelected + ">\n" +
                            "                        </div>\n" +
                            "                    </div>\n" +
                            "                    <input type=\"text\" class=\"form-control\" value=\"" + user + "\">\n" +
                            "                </div>")
                    }
                }
            }
        });
    }
}