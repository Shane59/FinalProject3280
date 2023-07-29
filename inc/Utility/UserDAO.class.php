<?php

class UserDAO {
    private static $db;
    
    static function init() {
        self::$db = new PDOService("User");
    }

    static function getUser(string $userName) :User {
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

    //update
    static function updateUser($newUser) {
        $update = "UPDATE users SET userName=:userName WHERE";
    }

    //delete
    static function deleteUser($user) {
        $delete = "DELETE FROM users WHERE userName = :userName";
        try {
            self::$db->query($delete);
            self::$db->bind(":userName", $user->getUserName());
            self::$db->execute();
            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem occured when deleting user name = " . $user->getUserName());
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
        return true;

    }
}

?>