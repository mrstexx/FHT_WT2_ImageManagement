
<div id="">	statt checkbox acitve oder inactive schreiben und je nachdem ein abnderes button setzen und ein button für delete und pw
<table class="table_user col-sm-12 col-md-6 col-lg-6">
    <tr>
        <th>Inactive</th>
        <th>Username</th>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>Email</th>
    </tr>
    <?php
    $db = new Database();
    if($db->connect()){
        $users = $db->get_users();
        if($users){
            while($row = $users->fetch_assoc())
			{

                $status = $row['status'];
				if ($status == 0)
				{
					$checked = 'checked';
				}
				else 
				{
					$checked = '';
				}

				echo '<tr>';
					echo "<td><input type='checkbox' name='inactive' value=".$row['pk_username']." class='inactiveChecked' ".$checked." ></td>";
					echo "<td class='inactiveUser'>".$row['pk_username']." </td>";
					echo '<td>'.$row['vorname'].'</td>';
					echo '<td>'.$row['nachname'].'</td>';
					echo '<td>'.$row['email'].'</td>';
					echo "<td><input type='submit' value='Select' name=".$row['pk_username']." class='select btn btn-primary btn-sm'/></td>";?>
				</tr>

			<?php }
		}?>
	</table>
    <?php } ?>