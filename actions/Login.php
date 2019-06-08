<?php
$documentRoot = $_SERVER['PHP_SELF'];
if (strpos($documentRoot, 'Login.php') != false) {
    include("../model/User.php");
    include("../model/Database.php");
} else {
    include("./model/User.php");
    include("./model/Database.php");
}
?>
<?php
if(isset($_POST['login_name'])){
    $ret_obj = new stdClass();
    $login_error = false;
    if(!empty($_POST['login_name'])){
        if(!isset($_POST['login_pw']) || empty($_POST['login_pw'])){
            $ret_obj->error = true;
            $ret_obj->error_message = 'Please fill out the full form';
            $login_error = true;
        }
    }
    else{
        $ret_obj->error = true;
        $ret_obj->error_message = 'Please fill out the full form';
        $login_error = true;
    }

    if(!$login_error){
        $is_email = false;
        $login_name = $_POST['login_name'];
        $login_pw = $_POST['login_pw'];
        if(filter_var($login_name, FILTER_VALIDATE_EMAIL)) {
            $is_email = true;//Valid email!
       }
        $db = new Database();
        //check if email or username is entered
        if(!$is_email){
            $user = new User($login_name,'', '', '', $login_pw);
            $username = $login_name;
        }
        else{
            $user = new User('','', '', $login_name, $login_pw);
        }
        if ($db->connect()) {
            $try_login = $user->login($db);
            if ($try_login == 0) {
                if($is_email){
                    $username=$user->get_username($db);
                }
                $login_success = true;
                $ret_obj->error = false;
                $_SESSION['user'] = $username;
                echo (json_encode($ret_obj));
            } else if($try_login == -1){
                $ret_obj->error = true;
                $ret_obj->error_message = "Please input correct username and password.";
                echo (json_encode($ret_obj));
            } 
            if ($db->close_con() == false) {
                $ret_obj->error = true;
                $ret_obj->error_message = 'Connection to database couldnt be closed properly';
                echo (json_encode($ret_obj));
            }
        } else {
            $ret_obj->error = true;
            $ret_obj->error_message = 'Connection to database failed';
            echo (json_encode($ret_obj));
        }
    }
}
?>