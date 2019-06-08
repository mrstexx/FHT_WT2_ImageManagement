<?php
include "actions/Login.php";
include "actions/Registration.php";
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="res/img/fav-icon.ico" type="image/x-icon"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="res/css/style.css">
    <title>Image Management</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img class="navbar-logo" src="res/img/fav-logo.png" alt="Logo image">
        Image Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-images"></i> Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> Help</a>
            </li>
        </ul>
        <form id="login_form" class="form-inline my-2 my-lg-0" role="form" action="" method="POST">
            <input id="tooltip_user" type="" data-toggle="tooltip" data-placement="bottom" title="Input your username or email" class="form-control form-control-sm mr-sm-2 test" name="login_name" placeholder="Email or username">
            <input data-toggle="tooltip" data-placement="bottom" title="Input your password" class="form-control form-control-sm mr-sm-2" type="password" name="login_pw" placeholder="Password"
                   aria-label="password">
            <button class="btn btn-sm btn-outline-dark my-2 my-sm-0" type="submit">Login <i
                        class="fas fa-sign-in-alt"></i></button>
        </form>
    </div>
</nav>
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
                        <h4>Create new account</h4>
                        <form id="reg_form" class="form" role="form" action="" method="POST">
                            <div class="form-group item">
                                <input id="registrate_vorname" placeholder="Vorname"
                                       class="form-control form-control-sm"
                                       type="text" name="register_vorname">
                            </div>
                            <div class="form-group item">
                                <input id="registrate_nachname" placeholder="Nachname"
                                       class="form-control form-control-sm" type="text" name="register_nachname">
                            </div>
                            <div class="form-group item">
                                <input id="registrate_username" placeholder="Username"
                                       class="form-control form-control-sm"
                                       type="text" name="register_username">
                            </div>
                            <div class="form-group item">
                                <input id="registrate_mail" placeholder="name@example.com"
                                       class="form-control form-control-sm" type="text" name="register_mail">
                            </div>
                            <div class="form-group item">
                                <input id="registrate_password1" placeholder="Password"
                                       class="form-control form-control-sm" type="password" name="register_password1">
                            </div>
                            <div class="form-group item">
                                <input id="registrate_password2" placeholder="Password"
                                       class="form-control form-control-sm" type="password" name="register_password2">
                            </div>

                            <div class="form-group item">
                                <button type="submit" value="continue" name="register_submit"
                                        class="btn btn-dark btn-block">Join the club
                                </button>
                            </div>
                        </form>
                        <div id="alertRegistration"></div>
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
<footer>
    <div class="container">
        Footer
    </div>
</footer>
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
</body>
</html>