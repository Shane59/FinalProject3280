<?php

class UserDAO {
    private static $db;
    
    static function init() {
        self::$db = new PDOService("User");
    }

    static function getUser(string $userName) {
        $select = "SELECT * FROM users WHERE username = :userName";
        self::$db->query($select);
        self::$db->bind(":userName", $userName);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function createuser($newUser) {
        $insert = "INSERT INTO users VALUES(:username, :first_name, :last_name, false, :password)";
        self::$db->query($insert);
        self::$db->bind(":username", $newUser->getUserName());
        self::$db->bind(":first_name", $newUser->getFirstName());
        self::$db->bind(":last_name", $newUser->getLastName());
        self::$db->bind(":password", password_hash($newUser->getPassword(), PASSWORD_DEFAULT));
        self::$db->execute();

        return self::$db->lastInsertedId();
    }
}

?>