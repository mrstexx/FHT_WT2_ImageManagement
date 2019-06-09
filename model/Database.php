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
        $user_info = $user_object->temp_userinfo();
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
        $user_info = $user_object->temp_userinfo();
        $user_existing = false;
        $user_selected;
        $pw_selected;
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

    public function fetch_accountinfo($user_object){
        $user_info = $user_object->temp_userinfo();
        $username = $user_info[0];
        $sql = "SELECT vorname, nachname, email FROM t_logindaten WHERE pk_username = ?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $username);
        $select->execute();
        $result = $select->get_result();
        $user_data = $result->fetch_assoc();
        $select->close();
        return $userData;
    }

    public function getFirstAndLastName($userName) {
        $result = null;
        $sql = "SELECT vorname, nachname FROM t_logindaten WHERE pk_username='" . $userName. "'";
        $result = $this->con->query($sql);
        if ($result->num_rows == 1) {
            $result = $result->fetch_object();
            return $result;
        }
        return null;
    }

    public function select_admin($userName) {
        $result = "";
        $sql = "SELECT admin FROM t_logindaten WHERE pk_username=?";
        $select = $this->con->prepare($sql);
        $select->bind_param("s", $userName);
        $select->execute();
        $select->bind_result($result);
        $select->fetch();
        $select->close();
        return $result;
    }
}
