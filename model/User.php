<?php

/**
 * Description of user
 *
 * @author Leo
 */
class User {

    private $username;
    private $vorname;
    private $nachname;
    private $mail;
    private $password;

    function __construct($reg_username, $reg_vorname, $reg_nachname, $reg_mail, $reg_password) {
        $this->username = $reg_username;
        $this->vorname = $reg_vorname;
        $this->nachname = $reg_nachname;
        $this->mail = $reg_mail;
        $this->password = $reg_password;
    }

    public function get_userinfo() {
        $user_info = array($this->username, $this->password, $this->vorname, $this->nachname, $this->mail);
        return $user_info;
    }

    public function register($database) {
        if ($database->register($this)) {
            return true;
        } else {
            return false;
        }
    }

}
