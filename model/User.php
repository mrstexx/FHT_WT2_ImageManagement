<?php

/**
 * Description of user
 *
 * @author Leo
 */
class User
{

    private $username;
    private $vorname;
    private $nachname;
    private $mail;
    private $password;

    function __construct($reg_username, $reg_vorname, $reg_nachname, $reg_mail, $reg_password)
    {
        $this->username = $reg_username;
        $this->vorname = $reg_vorname;
        $this->nachname = $reg_nachname;
        $this->mail = $reg_mail;
        $this->password = $reg_password;
    }

    public function get_userinfo()
    {
        $user_info = array($this->username, $this->password, $this->vorname, $this->nachname, $this->mail);
        return $user_info;
    }

    public function register($database)
    {
        if ($database->register($this)) {
            return true;
        } else {
            return false;
        }
    }

    public function login($database)
    {
        if ($database->login($this)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_username($database)
    {
        return $database->select_username($this);
    }

    public function account_info($database)
    {
        return $database->fetch_accountinfo($this);
    }

    public static function isUserAdmin($userName)
    {
        $db = new Database();
        if ($db->connect()) {
            $result = $db->fetch_accountinfo($userName);
            if ($result) {
                if ($result["admin"]) {
                    $db->close_con();
                    return true;
                }
            }
        }
        $db->close_con();
        return false;
    }

    public static function getFirstName($username)
    {
        $db = new Database();
        if ($db->connect()) {
            $result = $db->fetch_accountinfo($username);
            if ($result != null) {
                return $result["vorname"];
            }
        }
        return null;
    }

    public static function getLastName($username)
    {
        $db = new Database();
        if ($db->connect()) {
            $result = $db->fetch_accountinfo($username);
            if ($result != null) {
                return $result["nachname"];
            }
        }
        return null;
    }
    public function update_userinfo($database){
        if ($database->update_user($this)) {
            return true;
        } else {
            return false;
        }
    }
    public function send_mail(){
        $subject="Image Manager";
    	$message='Hallo '.$this->username.'! Ihr Password wurde von uns zurückgesetzt. Ihr neues Passwort lautet: '.$this->password;
		mail($this->mail, $subject, $message);
    }
}
