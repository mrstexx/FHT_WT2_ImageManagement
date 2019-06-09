$("#update_data").on("submit", function (e) {
    e.preventDefault(); // prevent reload
    $.ajax({
        type: "POST",
        url: "./inc/userdata.php",
        data: $(this).serialize(),
        success: function (response) {
            var payload = JSON.parse(response);
            if (payload.error) {
              alert(payload.error_message);
            } else {
                alert(payload.success_message);
            }
        }
    });
});