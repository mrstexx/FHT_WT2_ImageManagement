<?php
$username = $_SESSION['user'];
?>

<?php
$ret_obj = new stdClass();
$user = new User($username, '', '', '', '');
$db = new Database();
$vorname;
$nachname;
$mail;
if ($db->connect()) {
    $user_data = $user->account_info($db);
    $vorname = $user_data["vorname"];
    $nachname = $user_data["nachname"];
    $mail = $user_data["email"];
} else {
    
}
?>

<?php
if(isset($_POST['data_change'])){
$ret_obj = new stdClass();
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $vorname = $_POST['name'];
    }
    if (isset($_POST['surname']) && !empty($_POST['surname'])) {
        $nachname = $_POST['surname'];
    }
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $mail = $_POST['email'];
    }
    
    $user = new User($username, $vorname, $nachname, $mail, '');
    if ($user->update_userinfo($db)) {
        //$ret_obj->error = false;
        //$ret_obj->success_message = 'Your user information has been updated';
       // echo json_encode($ret_obj);
       echo 'Your user information has been updated';
    } else {
       // $ret_obj->error = true;
        //$ret_obj->error_message = 'Something went wrong';
       // echo json_encode($ret_obj);
       echo 'Something went wrong';
    }
}


    $password_old = " ";
    $password_new = " ";
    $password_conf = " ";
    if(isset($_POST['password_change'])){
    if (isset($_POST['password_old']) && !empty($_POST['password_old'])) {
        $password_old = $_POST['password_old'];
    }
    if (isset($_POST['password_new']) && !empty($_POST['password_new'])) {
        $password_new = $_POST['password_new'];
    }
    if (isset($_POST['password_conf']) && !empty($_POST['password_conf'])) {
        $password_conf = $_POST['password_conf'];
    }
    if ($password_old == " " || $password_new == " " || $password_conf == " ") {
       // $ret_obj->error = true;
        //$ret_obj->error_message = 'Please fill out the full form';
       // echo json_encode($ret_obj);
       echo 'Please fill out the full form';
    } else {
        if ($password_new != $password_conf) {
           // $ret_obj->error = true;
            //$ret_obj->error_message = 'Your passwords have to match';
          //  echo json_encode($ret_obj);
          echo 'Your passwords have to match';
        } else {
            $db = new Database();
            if ($db->connect()) {
                if ($db->update_password($username, $password_old, $password_new)) {
                //    $ret_obj->error = false;
                 //   $ret_obj->success_message = 'Your password has been changed';
              //      echo json_encode($ret_obj);
              echo 'Your password has been changed';
                } else {
                 //   $ret_obj->error = true;
                  //  $ret_obj->error_message = 'To change your password first correctly input your current password';
                  //  echo json_encode($ret_obj);
                  echo 'To change your password first correctly input your current password';
                }
            } else {
                
            }
        }
    }
}
    

?>
<div class="container col-md-9 user_data_con">
<div class="user_data_banner">
<div class="user_data">
<div id="alert_update"></div>
<div><h3>Change your data here</h3></div>
<form id="update_data" method="POST" action="">
  <div class="form-group">
    <label for="in_vorname">Vorname</label>
    <input name="name" class="form-control" type="text" <?php
echo "value='$vorname'";
?>>
  </div>
  <div class="form-group">
    <label for="in_nachname">Nachname</label>
    <input name="surname" class="form-control" type="text" <?php
echo "value='$nachname'";
?>>
  </div>
  <div class="form-group">
    <label class="form-group" for="in_mail">Email</label>
    <input name="email" class="form-control" type="email" <?php
echo "value='$mail'";
?>>
  </div>
  <button type="submit" value="continue" name="data_change" class="btn btn-secondary btn-block">Update data</button> 
</form>



<div><h3>Change your password here</h3></div>
<form id="update_password" method="POST" action="">
  <div class="form-group">
    <label for="in_old_pw">Current password</label>
    <input name="password_old" class="form-control" type="password">
  </div>
  <div class="form-group">
    <label for="in_new_pw">New password</label>
    <input name="password_new" class="form-control" type="password">
  </div>
  <div class="form-group">
    <label for="in_conf_pw">Confirm new password</label>
    <input name="password_conf" class="form-control" type="password">
  </div>
  <button type="submit" value="continue" name="password_change" class="btn btn-secondary btn-block">Update password</button>
</form>

</div>
</div>
</div>