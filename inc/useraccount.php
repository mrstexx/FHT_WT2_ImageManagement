<?php
    $username = $_SESSION['user'];
?>
<form id="login_form" class="form-inline my-2 my-lg-0" role="form" action="" method="POST">
<input id="tooltip_user" type="" data-toggle="tooltip" data-placement="bottom"
       title="Input your username or email" class="form-control form-control-sm mr-sm-2 test"
       name="login_name" placeholder="Email or username" required>
<input data-toggle="tooltip" data-placement="bottom" title="Input your password"
       class="form-control form-control-sm mr-sm-2" type="password" name="login_pw" placeholder="Password"
       aria-label="password" required>
<button class="btn btn-sm btn-outline-dark my-2 my-sm-0" type="submit">Login <i
            class="fas fa-sign-in-alt"></i></button>
</form>

<?php
if(isset($_POST['changedata_but'])){
    $user = new User($username,'', '', '', '');
    $db = new Database();
    if ($db->connect()) {
        $user_data = $user->account_info($db);
    }
    else {

    }
    $vorname = $user_data[$vorname];
    $nachname = $user_data[$nachname];
    $mail = $user_data[$email];
}
?>

<form id="updateDataForm" method="POST" action=<?php echo $_SERVER['PHP_SELF']; ?>>
        <table>
            <tr>
                <td>User name:</td>
                <td><input id="username" class="form-control" name="user" type="text"<?php echo "value='$username'"; ?>></td>
            </tr>
            <tr>
                <td>First name:</td>
                <td><input name="name" class="form-control accountInput" type="text" <?php echo "value='$vorname'"; ?>></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><input name="surname" class="form-control accountInput" type="text" <?php echo "value='$nachname'"; ?>></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input name="email" class="form-control accountInput" type="email" <?php echo "value='$mail'"; ?>></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input name="password" class="form-control accountInput" type="password"></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input name="passwordConfirmation" class="form-control accountInput" type="password"></td>
            </tr>                   
        </table>  
    </form>