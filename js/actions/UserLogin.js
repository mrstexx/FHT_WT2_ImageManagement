$("#login_form").on("submit", function (e) {
    e.preventDefault(); // prevent reload
    $.ajax({
        type: "POST",
        url: "./actions/Login.php",
        data: $(this).serialize(),
        success: function (response) {
            var payload = JSON.parse(response);
            if (payload.error) {
                $('#tooltip_user').attr('data-original-title', payload.error_message);
                $('#tooltip_user').tooltip('show');
                setTimeout(function () {
                    $('#tooltip_user').tooltip('hide');
                    $('#tooltip_user').attr('data-original-title', 'Input your username or email');
                }, 2000);
            } else {
                location.reload();
            }
        }
    });
});