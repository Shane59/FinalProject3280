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
}

?>