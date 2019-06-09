<main>
    <div class="container">
        <div class="registration-banner">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="text-center">Welcome to our application</h2>
                    <img class="home-background-image" src="res/img/background.png" alt="Background image">
                </div>
                <div class="col-md-5">
                    <div class="registration-area">
                        <?php
                        if (isset($isAdmin)) {
                            $userData = User::getFirstAndLastName($_SESSION["user"]);
                            echo "<h4>Welcome back " . $userData->vorname . " " . $userData->nachname . "</h4>
                                  <br>
                                  <a href='?page=feed' class=\"btn btn-secondary btn-block\">Check new posts</a>
                                  <a href='?page=manager' class=\"btn btn-secondary btn-block\">Manage your images</a>
                                  <a href='?page=userdata' class=\"btn btn-secondary btn-block\">Change your personal information</a>";
                        } else {
                            echo "<h4>Create new account</h4>
                                <form id=\"reg_form\" class=\"form\" role=\"form\" action=\"\" method=\"POST\">
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_vorname\" placeholder=\"Vorname\"
                                               class=\"form-control form-control-sm\"
                                               type=\"text\" name=\"register_vorname\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_nachname\" placeholder=\"Nachname\"
                                               class=\"form-control form-control-sm\" type=\"text\" name=\"register_nachname\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_username\" placeholder=\"Username\"
                                               class=\"form-control form-control-sm\"
                                               type=\"text\" name=\"register_username\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_mail\" placeholder=\"name@example.com\"
                                               class=\"form-control form-control-sm\" type=\"text\" name=\"register_mail\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_password1\" placeholder=\"Password\"
                                               class=\"form-control form-control-sm\" type=\"password\" name=\"register_password1\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_password2\" placeholder=\"Password\"
                                               class=\"form-control form-control-sm\" type=\"password\" name=\"register_password2\">
                                    </div>
        
                                    <div class=\"form-group item\">
                                        <button type=\"submit\" value=\"continue\" name=\"register_submit\"
                                                class=\"btn btn-secondary btn-block\">Join the club
                                        </button>
                                    </div>
                                </form>
                                <div id=\"alertRegistration\"></div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-us">
            <h3>About Us</h3>
            <div class="row">
                <div class="col-md-4">
                    <img src="https://www.politieonderzoeken.nl/wp-content/themes/flymag/images/placeholder.png" alt="">
                    <h4 class="text-center">Leo Gruber</h4>
                </div>
                <div class="col-md-4">
                    <img src="https://www.politieonderzoeken.nl/wp-content/themes/flymag/images/placeholder.png" alt="">
                    <h4 class="text-center">Marius Hochwald</h4>
                </div>
                <div class="col-md-4">
                    <img src="https://www.politieonderzoeken.nl/wp-content/themes/flymag/images/placeholder.png" alt="">
                    <h4 class="text-center">Stefan Miljevic</h4>
                </div>
            </div>
        </div>
    </div>
</main>

<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="./js/actions/UserRegistration.js"></script>
<script src="./js/actions/UserLogin.js"></script>
<script src="./js/tooltip_activate.js"></script>
<script src="./js/actions/update_userdata.js"></script>
<script src="./js/actions/update_userpassword.js"></script>