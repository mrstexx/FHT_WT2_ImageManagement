<?php
class Database {

    private $con = NULL;

    public function connect() {
        $this->con = new mysqli('localhost', 'root', '', 'imagemanagement');
        if ($this->con->connect_error) {
            return false;
        }
        return true;
    }

    public function close_con() {
        if ($this->con != NULL) {
            return ($this->con)->close();
        }
        return false;
    }

    public function register($user_object) {
        $user_info = $user_object->get_userinfo();
        $sql_username = "SELECT pk_username FROM t_logindaten";
        $result = $this->con->query($sql_username);
        while ($row = $result->fetch_object()) {
            if ($row->pk_username == $user_info[0]) {
                $result->close();
                return false;
            }
        }
        $result->close();
        $sql_email = "SELECT email FROM t_logindaten";
        $result_mail = $this->con->query($sql_email);
        while ($row = $result_mail->fetch_object()) {
            if ($row->email == $user_info[4]) {
                $result_mail->close();
                return false;
            }
        }
        $result_mail->close();
        $sql = "INSERT INTO t_logindaten (pk_username, password, vorname ,nachname, email, status, admin) VALUES (?, ?, ?, ?, ?, 1, 0)";
        $insert = $this->con->prepare($sql);
        $pwhashed = password_hash($user_info[1], PASSWORD_DEFAULT);
        $insert->bind_param("sssss", $user_info[0], $pwhashed, $user_info[2], $user_info[3], $user_info[4]);
        if($insert->execute()){
            $insert->close();
            return true;
        }
        else{
        $insert->close();
        return false;
        }
    }

    public function login($user_object){
        $user_info = $user_object->get_userinfo();
        $user_existing = false;
        $user_selected = null;
        $pw_selected = null;
        if($user_info[0] == ''){
            $sql = "SELECT email FROM t_logindaten WHERE email = ?";
            $select = $this->con->prepare($sql);
            $select->bind_param("s", $user_info[4]);
            $select->execute();
            $select->bind_result($user_selected);
            $select->fetch();
            $select->close();
            if($user_selected == $user_info[4]){
                $sqlpw = "SELECT password FROM t_logindaten WHERE email = '".$user_selected."'";
                $result = $this->con->query($sqlpw);
                $result = $result->fetch_object();
                $pwdb= $result->password;
                if(password_verify($user_info[1], $pwdb)){
                    // echo 'login success';
                    return 0;
                }
                else {
                    return -1;     //password does not match
                }
            }
            else{
                return -1;       // email does not match
            }
        }
        else{
        $sql = "SELECT pk_username FROM t_logindaten WHERE pk_username = ?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $user_info[0]);
        $select->execute();
        $select->bind_result($user_selected);
        $select->fetch();
        $select->close();
        if($user_selected == $user_info[0]){
            $sqlpw = "SELECT password FROM t_logindaten WHERE pk_username ='".$user_selected."'";
            $result = $this->con->query($sqlpw);
            $result = $result->fetch_object();
            $pwdb= $result->password;
                if(password_verify($user_info[1], $pwdb)){
                    // echo 'login success';
                    return 0;
                }
                else {
                    return -1; //password does not match
                }
        }
        else{
            return -1;       // username does not match
        }
    }

    }

    public function select_username($user_object){
        $user_info = $user_object->get_userinfo();
        $user_selected = "";
        $sql = "SELECT pk_username FROM t_logindaten WHERE email = ?";
            $select = $this->con->prepare($sql);
            $select->bind_param("s", $user_info[4]);
            $select->execute();
            $select->bind_result($user_selected);
            $select->fetch();
            $select->close();
            return $user_selected;
    }

    public function fetch_accountinfo($user_data){
        $username = null;
        if (is_string($user_data)) {
            $username = $user_data;
        } else {
            $user_info = $user_data->get_userinfo();
            $username = $user_info[0];
        }
        $sql = "SELECT vorname, nachname, email, admin FROM t_logindaten WHERE pk_username = ?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $username);
        $select->execute();
        $result = $select->get_result();
        $user_data = $result->fetch_assoc();
        $select->close();
        return $user_data;
    }

    public function update_user($user_object){
        $user_info = $user_object->get_userinfo();
        $username = $user_info[0];
        $vorname = $user_info[2];
        $nachname = $user_info[3];
        $mail = $user_info[4];
        $sqlup = "UPDATE t_logindaten SET vorname=?, nachname=?, email=? WHERE pk_username = ?";
        $update = $this->con->prepare($sqlup);
        $update->bind_param("ssss", $vorname, $nachname, $mail, $username);
        if($update->execute()){
            $update->close();
            return true;
        }
        else{
           $update->close();
           return false;
        }
    }

    public function update_password($user_name, $password_old, $password_new){
        $sqlpw = "SELECT password FROM t_logindaten WHERE pk_username ='".$user_name."'";
        $result = $this->con->query($sqlpw);
        $result = $result->fetch_object();
        $pwdb= $result->password;
        //check if old password matches db password
        if(password_verify($password_old, $pwdb)){
            //hash new password and update db
            $pwhashed = password_hash($password_new, PASSWORD_DEFAULT);
            $sqlup = "UPDATE t_logindaten SET password=? WHERE pk_username = ?";
            $update = $this->con->prepare($sqlup);
            $update->bind_param("ss", $pwhashed, $user_name);
            $update->execute();
            $update->close();
            return true;
            }
        //old password wasnt correct
        else{
            return false;
        }
    }

    public function addNewImage($owner, $imageName, $directory, $thumbDir, $geoInfo) {
        $sql = "INSERT INTO t_bilder (pk_bild_id, fk_pk_username , name, geoinfo, aufnahmedatum, directory, thumbnail_directory) 
            VALUES (DEFAULT, ?, ?, ?, NOW(), ?, ?)"; // fk_pk_geoinfo gelöscht und null gelöscht
        $insert = $this->con->prepare($sql);
        $insert->bind_param("sssss", $owner, $imageName, $geoInfo, $directory, $thumbDir);
        if($insert->execute()){
            $insert->close();
            return true;
        }
        $insert->close();
        return false;
    }

    public function fetchAllUserImages($userName)
    {
        $images = array();
        $sql = "SELECT pk_bild_id, name, geoinfo, aufnahmedatum, directory, thumbnail_directory FROM t_bilder  WHERE fk_pk_username = ?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $userName);
        $select->execute();
        $result = $select->get_result();
        while ($row = $result->fetch_assoc()) {
            array_push($images, $row);
        }
        $select->close();
        return $images;
    }
	
	public function fetchAllImages($userName)
    {
        $images = array();
        $sql = "SELECT fk_pk_bild_id, t_bilder.fk_pk_username, t_bilder.pk_bild_id, t_bilder.name, t_bilder.geoinfo, t_bilder.aufnahmedatum, t_bilder.directory, t_bilder.thumbnail_directory FROM t_user_access INNER JOIN t_bilder ON t_user_access.fk_pk_bild_id = t_bilder.pk_bild_id WHERE t_user_access.fk_pk_username = ?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $userName);
        $select->execute();
        $result = $select->get_result();
        while ($row = $result->fetch_assoc()) {
            array_push($images, $row);
        }
        $select->close();
        return $images;
    }

    public function checkImageName($imageName) {
        $sql = "SELECT name FROM t_bilder WHERE name=?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $imageName);
        $select->execute();
        $result = $select->get_result();
        $select->close();
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function getImageData($imageID) {
        $sql = "SELECT name, directory, thumbnail_directory, geoinfo FROM t_bilder WHERE pk_bild_id = ?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $imageID);
        $select->execute();
        $result = $select->get_result();
        $select->close();
        if ($result) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function deleteImage($imgID) {
        $sql = "DELETE FROM t_bilder WHERE pk_bild_id = ?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $imgID);
        $select->execute();
        if ($select->errno == 0) {
            $select->close();
            return true;
        }
        $select->close();
        return false;
    }

    public function get_users()
    {
        $sql = "SELECT * FROM t_logindaten WHERE admin=0";
        $select = $this->con->prepare($sql);
        $select->execute();
        $users = $select->get_result();
        $select->close();
        if ($users) {
            return $users;
        }
        return null;
    }
	
    public function getUserTags($imageID) {
        // TODO STEFAN Make safety DB query handling
        $sql = "SELECT fk_pk_tags FROM t_tags_included WHERE fk_pk_bild_id=?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $imageID);
        $select->execute();
        $result = $select->get_result();
        $tags = array();
        while ($row = $result->fetch_assoc()) {
            array_push($tags, $row["fk_pk_tags"]);
        }
        $select->close();
        return $tags;
    }

    public function addNewTag($tagName) {
        // TODO STEFAN Make safety DB query handling
        $sql = "INSERT INTO t_tags VALUES(?)";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $tagName);
        $select->execute();
        $select->close();
    }

    public function addTagToImage($imageID, $tagName) {
        // TODO STEFAN Make safety DB query handling
        $sql = "INSERT INTO t_tags_included VALUES(?,?)";
        $select = $this->con->prepare($sql);
        $select->bind_param("ss", $tagName, $imageID);
        $select->execute();
        $select->close();
    }

    public function deleteTag($imageID, $tagName) {
        // TODO STEFAN Make safety DB query handling
        $sql = "DELETE FROM t_tags_included WHERE fk_pk_tags=? AND fk_pk_bild_id=?";
        $select = $this->con->prepare($sql);
        $select->bind_param("ss", $tagName, $imageID);
        $select->execute();
        $select->close();
    }

    public function getAvailableUsers($loggedUser) {
        $sql = "SELECT pk_username FROM t_logindaten WHERE status=1 AND admin=0 AND pk_username NOT LIKE ?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $loggedUser);
        $select->execute();
        $result = $select->get_result();
        $users = array();
        while ($row = $result->fetch_assoc()) {
            array_push($users, $row["pk_username"]);
        }
        $select->close();
        return $users;
    }

    public function getUserImageSelection($imageID) {
        $sql = "SELECT fk_pk_username FROM t_user_access WHERE fk_pk_bild_id=?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $imageID);
        $select->execute();
        $result = $select->get_result();
        $users = array();
        while ($row = $result->fetch_assoc()) {
            array_push($users, $row["fk_pk_username"]);
        }
        $select->close();
        return $users;
    }

    public function addNewSelection($userName, $imageID) {
        // TODO STEFAN Make safety DB query handling
        $sql = "INSERT INTO t_user_access VALUES(?,?)";
        $select = $this->con->prepare($sql);
        $select->bind_param("ss", $userName, $imageID);
        $select->execute();
        $select->close();
    }

    public function deleteSelection($userName, $imageID) {
        // TODO STEFAN Make safety DB query handling
        $sql = "DELETE FROM t_user_access WHERE fk_pk_username=? AND fk_pk_bild_id=?";
        $select = $this->con->prepare($sql);
        $select->bind_param("ss", $userName, $imageID);
        $select->execute();
        $result = $select->get_result();
        $select->close();
    }

    public function get_userstatus($username){
        $sql = "SELECT status FROM t_logindaten WHERE pk_username=?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $username);
        $select->execute();
        $result = $select->get_result();
        $user_status = $result->fetch_assoc();
        $select->close();
        if ($user_status['status'] == 1) {
            return true;
        }
        return false;
	}
	
    public function update_userstatus($username, $status){
        $newstatus = 1;
        if($status == 1){
            $newstatus = 0;
        }
        $sqlup = "UPDATE t_logindaten SET status=? WHERE pk_username = ?";
        $update = $this->con->prepare($sqlup);
        $update->bind_param("ss", $newstatus, $username);
        if($update->execute()){
            $update->close();
            return true;
        }
        else{
           $update->close();
           return false;
        }
    }

    public function pw_reset($username,$password_new){
        $sqlup = "UPDATE t_logindaten SET password=? WHERE pk_username = ?";
        $update = $this->con->prepare($sqlup);
        $update->bind_param("ss", $password_new, $username);
        if($update->execute()){
            $update->close();
            return true;
        }
        else{
           $update->close();
           return false;
        }
    }

    public function get_mail($username){
        $sql = "SELECT email FROM t_logindaten WHERE pk_username=?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $username);
        $select->execute();
        $result = $select->get_result();
        $user_mail = $result->fetch_assoc();
        $select->close();
        return $user_mail;
    }

    public function delete_user($user_name){
        $sql = "DELETE FROM t_logindaten WHERE pk_username = ?";
        $delete = $this->con->prepare($sql);
        $delete->bind_param("s", $user_name);
        $delete->execute();
        if ($delete->errno == 0) {
            $delete->close();
            return true;
        }
        $delete->close();
        return false;
    }

    public function all_tags(){
        $sql = "SELECT pk_tags FROM t_tags";
        $select = $this->con->prepare($sql);
        $select->execute();
        $result = $select->get_result();
        $tags = array();
        while ($row = $result->fetch_assoc()) {
            array_push($tags, $row["pk_tags"]);
        }
        $select->close();
        return $tags;
    }

    public function fetch_all_images_with_tag($userName){
        $images = array();
        $sql = "select bilder.*, tags.fk_pk_tags as tag from
        (select * FROM t_bilder where fk_pk_username = ?) bilder
        join
        (select * from t_tags_included)tags 
        on bilder.pk_bild_id=tags.fk_pk_bild_id";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $userName);
        $select->execute();
        $result = $select->get_result();
        while ($row = $result->fetch_assoc()) {
            array_push($images, $row);
        }
        $select->close();
        return $images;
    }

    public function fetch_all_images_with_tag_shared($userName){
        $images = array();
        $sql = "select bilder.*, tags.fk_pk_tags as tag from
        (select a.fk_pk_username, a.pk_bild_id, a.name, a.geoinfo, a.aufnahmedatum, a.directory, a.thumbnail_directory FROM t_bilder a join t_user_access b on a.pk_bild_id=b.fk_pk_bild_id where b.fk_pk_username = ?) bilder
        join
        (select * from t_tags_included)tags 
        on bilder.pk_bild_id=tags.fk_pk_bild_id";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $userName);
        $select->execute();
        $result = $select->get_result();
        while ($row = $result->fetch_assoc()) {
            array_push($images, $row);
        }
        $select->close();
        return $images;
    }
}