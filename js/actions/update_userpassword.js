$("#update_password").on("submit", function (e) {
    e.preventDefault(); // prevent reload
    $.ajax({
        type: "POST",
        url: "./inc/userdata.php",
        data: $(this).serialize(),
        success: function (response) {
            var payload = JSON.parse(response);
            if (payload.error) {
               $("#alert_update").append("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    payload.error_message +
                    "</div>");
            } else {
               $("#alert_update").append("<div class=\"alert alert-success\" role=\"alert\">\n" +
                    payload.success_message +
                    "</div>");
            }
        }
    });
});