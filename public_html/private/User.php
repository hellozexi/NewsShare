<?php

include_once 'db.php';

class User
{
    private $email;
    // you can change nickname
    public $nickname;
    private $hashed_passwd;

    public function GetEmail() {
        return $this->email;
    }

    public function GetNickname() {
        return $this->nickname;
    }

    private function __construct($email, $nickname, $hashed_passwd) {
        $this->email = $email;
        $this->nickname = $nickname;
        $this->hashed_passwd = $hashed_passwd;
    }

    // for new user register
    // use User::Create() to create a new user
    public static function Create($email, $nickname, $passwd) {
        $hashed_password = password_hash($passwd, PASSWORD_BCRYPT);
        return new User($email, $nickname, $hashed_password);
    }

    // search users by their email
    public static function SearchByEmail($email) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT email, nickname, password FROM users WHERE email=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($_email, $_nickname, $_password);
        
        if ($stmt->fetch()) {
            $stmt->close();
            return new User($_email, $_nickname, $_password);
        }
        return null;
    }

    public function Save() {
        global $mysqli;
        $stmt = $mysqli->prepare("INSERT INTO users (email, nickname, password) VALUES (?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('sss', $this->email, $this->nickname, $this->hashed_passwd);
        $stmt->execute();
        $stmt->close();
    }

    public function Validate($passwd) {
        if (password_verify($passwd, $this->hashed_passwd)) {
            return true;
        }
        return false;
    }
}
