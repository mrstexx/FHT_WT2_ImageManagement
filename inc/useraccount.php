<?php
if(isset($_POST['user_selected'])){
	$user = $_POST['user_selected'];
	$db = new Database();
    if($db->connect()){
		if(isset($_POST['status_update'])){
			$status = $db->get_userstatus($user); // fetch status 
			if($db->update_userstatus($user, $status)){ //update status
				echo 'Status of user '.$user.' successfully updated';
			}
			else{
				echo 'Error while updating user status';
			}
		}
		if(isset($_POST['delete_user'])){
			//to implement delete user and cascade images

		}
		if(isset($_POST['pw_reset'])){
			//create new pw
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$rdmpw = array(); 
			$alphaLength = strlen($alphabet) - 1;
			for ($i = 0; $i < 11; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}
			$newpw = implode($pass); //turn the array into a string
			$pwhash = password_hash($newpw, PASSWORD_DEFAULT);
			if($db->pw_reset($user, $pwhash)){
				$res = $db->get_mail($user);
				$mail = $res['email'];
				$user_obj = new User($user, '', '', $mail, $pwhash);
				$user_obj->send_mail();
				echo 'Password reset and email sent';
			}
			else{
				echo 'Error at passwort reset';
				}
		}
	}
}
else{
	echo 'Please select a user first';
}
?>
<div id="">
<form class="form" role="" action="" method="POST"> 
<table class="table_user col-sm-12 col-md-6 col-lg-6">
    <tr>
        <th>Status</th>
        <th>Username</th>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>Email</th>
		<th> Select a user </th>
    </tr>
    <?php
	$temp;
	$temp2;
    $db = new Database();
    if($db->connect()){
        $users = $db->get_users();
        if($users){
            while($row = $users->fetch_assoc())
			{

                $status = $row['status'];
				if ($status == 0)
				{
					$temp = 'Inactive';
					$temp2 = 'Active';
				}
				else 
				{
					$temp = 'Active';
					$temp2= 'Inactive';
				}

				echo '<tr>';
					echo "<td>".$temp."</td>";
					echo "<td class='inactiveUser'>".$row['pk_username']." </td>";
					echo '<td>'.$row['vorname'].'</td>';
					echo '<td>'.$row['nachname'].'</td>';
					echo '<td>'.$row['email'].'</td>';
					echo "<td><input type='checkbox' value='".$row['pk_username']."' name='user_selected'></td>";?>
					
				</tr>

			<?php }
				echo "<td><input type='submit' value='Update Status' name='status_update' class='select btn btn-primary btn-sm'/></td>";
			echo "<td><input type='submit' value='Delete User' name='delete_user' class='select btn btn-primary btn-sm'/></td>";
			echo "<td><input type='submit' value='Reset password' name='pw_reset' class='select btn btn-primary btn-sm'/></td>";
			
		}?>
	</table>
	</form>
    <?php } ?>