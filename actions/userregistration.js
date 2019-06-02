$("#reg_form").on("submit", function (e) {
        e.preventDefault(); // prevent reload
        $("#alertRegistration").empty(); // empty html for alert message
        $.ajax({
            type: "POST",
            url: "./Registration.php",
            data: $(this).serialize(),
            success: function (ret_obj) {
                console.log((ret_obj));
               var payload = JSON.parse(ret_obj);
                if (payload.userExisting) {
                    $("#alertRegistration").append("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                        "Username already used. Please try again." +
                        "</div>");
                } else if(payload.password_error){
					$("#alertRegistration").append("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                        "Passwords don't match." +
                        "</div>");
				}
				else if(payload.reg_success){
                    $("#alertRegistration").append("<div class=\"alert alert-success\" role=\"alert\">\n" +
                        "User created successfully. You will be redirected..." +
                        "</div>");
                }
				else{
					alert("troll");
				}
            }
        });
    });