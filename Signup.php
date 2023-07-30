<?php

require_once('inc/config.inc.php');
require_once('inc/Entity/User.class.php');
require_once('inc/Entity/Page.class.php');

require_once('inc/Utility/LoginManager.php');
require_once('inc/Utility/PDOService.class.php');
require_once('inc/Utility/UserDAO.class.php');

UserDAO::init();
$error = array();

if (isset($_POST['action']) && $_POST['action'] == "signup") {
    //signup func
    $newUser = new User();
    $newUser->setUserName($_POST['username']);
    if ($newUser->getUserName() == "") {
        array_push($error, "Username cannot be enpty");
    }
    $newUser->setFirstName($_POST['firstname']);
    if ($newUser->getFirstName() == "") {
        array_push($error, "First name cannot be enpty");
    }
    $newUser->setLastName($_POST['lastname']);
    if ($newUser->getLastName() == "") {
        array_push($error, "Last name cannot be enpty");
    }
    $newUser->setAdmin(false);
    $newUser->setPassword($_POST['password']);
    if ($newUser->getPassword() == "") {
        array_push($error, "Password cannot be enpty");
    }
    try {
        if (sizeof($error)) {
            foreach($error as $e) {
                echo "<p>" . $e . "</p>";
            }
            throw new Exception();
        }
        UserDAO::createuser($newUser);
        session_start();
        $_SESSION['username'] = $newUser->getUserName();
        header("Location: FinalProject_SAo69796.php");;
        exit;
    } catch (Exception $e) {
        if (sizeof($error) == 0) {
            echo "<h2>something went wrong, please contact the IT team.</h2>";
        }
        error_log($e->getMessage());
    }
}
Page::header();
Page::showSignupForm();
Page::footer();

?>