<?php

class AccountModel extends BaseModel {

    public function login($username, $password) {

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
