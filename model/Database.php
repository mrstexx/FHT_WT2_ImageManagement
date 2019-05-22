<?php

/**
 * Description of Database
 *
 * @author Leo
 */
/*
 * with database name  'ImageManagement'
 
  CREATE TABLE `users` (
  `username` varchar(32) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `vorname` varchar(32) DEFAULT NULL,
  `nachname` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`username`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1
 */
class Database {

    private $con = NULL;

    public function connect() {
        $this->con = new mysqli('localhost', 'root', '', 'ImageManagement');
        if ($this->con->connect_error) {
            return false;
        }
        return true;
    }

    public function close_con() {
        if ($this->con != NULL) {
            return ($this->con)->close();
        }
    }

    public function register($user_object) {
        $user_info = $user_object->get_userinfo();
        $sql_username = "SELECT username FROM users";
        $result = $this->con->query($sql_username);
        while ($row = $result->fetch_object()) {
            if ($row->username == $user_info[0]) {
                $result->close();
                return false;
            }
        }
        $result->close();
        $sql = "INSERT INTO users (username, pwd, vorname ,nachname, email, is_admin) VALUES (?, ?, ?, ?, ?, false)";
        $insert = $this->con->prepare($sql);
        $pwhashed = password_hash($user_info[1], PASSWORD_DEFAULT);
        $insert->bind_param("sssss", $user_info[0], $pwhashed, $user_info[2], $user_info[3], $user_info[4]);
        $insert->execute();
        $insert->close();
        return true;
    }

}
