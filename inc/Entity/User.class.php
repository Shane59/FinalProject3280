<?php

class User {
    private $userName;
    private $first_name;
    private $last_name;
    private $isAdmin;
    private $password;

    function getUserName() {
        return $this->userName;
    }
    function getFirstName() {
        return $this->first_name;
    }
    function getLastName() {
        return $this->last_name;
    }
    function getIsAdmin() {
        return $this->isAdmin;
    }
    function getPassword() {
        return $this->password;
    }
    function verifyPassWord(string $pass) {
        return password_verify($pass, $this->getPassword());
    }

    function setUserName($username) {
        $this->userName = $username;
    }
    function setFirstName($firstname) {
        $this->first_name = $firstname;
    }
    function setLastName($lastname) {
        $this->last_name = $lastname;
    }
    function setAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }
    function setPassword($password) {
        $this->password = $password;
    }
}

?>