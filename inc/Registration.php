<?php
include "./model/User.php";
include "./model/Database.php";
?>

<?php
    function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
if (isset($_POST["register_submit"])) {
    $error = false;
    $password_match = false;
    $register_success = false;
    $ret_obj = new stdClass();
    $fields = array('register_vorname', 'register_nachname', 'register_username', 'register_password1', 'register_password2', 'register_mail');
    foreach ($fields as $fieldname) {
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            echo 'Field is missing. Please fill out the full form <br />';
            $error = true;
            $ret_obj->empty = true;
        }
    }
    if ($error == false) {
        if ($_POST['register_password1'] == $_POST['register_password2']) {
            $password_match = true;
        } else {
            $ret_obj->password_error = true;
            $ret_obj->error_message = "Passwords don't match";
        }
    }
    if ($password_match) {
        $user = new User($_POST['register_username'], $_POST['register_vorname'], $_POST['register_nachname'], $_POST['register_mail'], $_POST['register_password1']);
        $db = new Database();
        if ($db->connect()) {
            if ($user->register($db)) {
                $register_success = true;
                $ret_obj->reg_success = true;
            } else {
                $ret_obj->userExisting = true;
                $ret_obj->error_message = "Username already used. Please try again.";
            }
            if ($db->close_con() == false) {
                echo 'Connection to database couldnt be closed properly';
            }
        } else {
            echo 'Connection to database failed';
        }
    }
    echo (json_encode($ret_obj));
}
?>
