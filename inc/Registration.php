<?php
include ".\User.php";
include ".\Database.php";
?>

<?php
if (isset($_POST["register_submit"])) {
    $error = false;
    $password_match = false;
    $register_success = false;
    $fields = array('register_vorname', 'register_nachname', 'register_username', 'register_password1', 'register_password2', 'register_mail');
    foreach ($fields as $fieldname) {
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            echo 'Field is missing. Please fill out the full form <br />';
            $error = true;
        }
    }
    if ($error == false) {
        if ($_POST['register_password1'] == $_POST['register_password2']) {
            $password_match = true;
        } else {
            echo 'Passwords dont match';
        }
    }
    if ($password_match) {
        $user = new User($_POST['register_username'], $_POST['register_vorname'], $_POST['register_nachname'], $_POST['register_mail'], $_POST['register_password1']);
        $db = new Database();
        if ($db->connect()) {
            if ($user->register($db)) {
                $register_success = true;
            } else {
                echo 'Username ' . $_POST['register_username'] . 'is already taken';
            }
            if ($db->close_con() == false) {
                echo 'Connection to database couldnt be closed properly';
            }
        } else {
            echo 'Connection to database failed';
        }
    }
}
?>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
              integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <title>Registration</title>
    </head>
    <body>
        <div id="registration_form" class="container">
            <form class="form" role="form" action="" method="POST">
                <div class="form-group item">
                    <input id="registrate_vorname" placeholder="Vorname" class="form-control form-control-sm"
                           type="text" name="register_vorname">
                </div>
                <div class="form-group item">
                    <input id="registrate_nachname" placeholder="Nachname"
                           class="form-control form-control-sm" type="text" name="register_nachname">
                </div>
                <div class="form-group item">
                    <input id="registrate_username" placeholder="Username" class="form-control form-control-sm"
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
                            class="btn btn-dark btn-block">Join the club</button>
                </div>
            </form>
        </div>
        <?php
        if(isset($register_success) && $register_success){ ?>
        <div class ="container">
            <h3> Welcome to the club <?php echo $_POST['register_username'].'! You can now login :)'; ?>
            <a href='.\login.php'><button class="btn btn-dark btn-block">Go to login page</button></a>
        </div>
        <?php } ?>
    </body>