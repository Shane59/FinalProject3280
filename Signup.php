<?php

require_once('inc/config.inc.php');
require_once('inc/Entity/User.class.php');
require_once('inc/Entity/Page.class.php');

require_once('inc/Utility/LoginManager.php');
require_once('inc/Utility/PDOService.class.php');
require_once('inc/Utility/UserDAO.class.php');

UserDAO::init();

if (isset($_POST['action']) && $_POST['action'] == "signup") {
    //signup func
    $newUser = new User();
    $newUser->setUserName($_POST['username']);
    $newUser->setFirstName($_POST['firstname']);
    $newUser->setLastName($_POST['lastname']);
    $newUser->setAdmin(false);
    $newUser->setPassword($_POST['password']);
    try {
        UserDAO::createuser($newUser);
        session_start();
        $_SESSION['username'] = $newUser->getUserName();
        header("Location: FinalProject_SAo69796.php");;
        exit;
    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}
Page::header();
Page::showSignupForm();
Page::footer();

?>