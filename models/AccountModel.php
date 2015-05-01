<?php

class AccountModel extends BaseModel {

    public function login($username, $password) {
        if($username == '') {
            return false;
        }

        $statement = self::$db->query("SELECT pass_hash FROM users WHERE username = '$username'");
        $result = $statement->fetch_all(MYSQLI_ASSOC);
        if(!count($result)) {
            return false;
        } else {
            if(password_verify($password, $result[0]['pass_hash'])) {
                return true;
            } else {
                return false;;
            }
        }
    }

    public function register($username, $pass_hash) {
        $zero = 0;
        $statement = self::$db->prepare(
            "INSERT INTO users VALUES(NULL, ?, ?, ?)");
        $statement->bind_param("ssi", $username, $pass_hash, $zero);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
