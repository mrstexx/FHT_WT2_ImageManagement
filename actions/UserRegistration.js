$("#reg_form").on("submit", function (e) {
    e.preventDefault(); // prevent reload
    $("#alertRegistration").empty(); // empty html for alert message
    $.ajax({
        type: "POST",
        url: "./inc/Registration.php",
        data: $(this).serialize(),
        success: function (response) {
            var payload = JSON.parse(response);
            if (payload.error) {
                $("#alertRegistration").append("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    payload.error_message +
                    "</div>");
            } else {
                $("#alertRegistration").append("<div class=\"alert alert-success\" role=\"alert\">\n" +
                    payload.success_message +
                    "</div>");
            }
        }
    });
});