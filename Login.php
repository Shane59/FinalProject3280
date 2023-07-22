<?php
require_once('inc/config.inc.php');
require_once('inc/Entity/User.class.php');
require_once('inc/Entity/Page.class.php');

require_once('inc/Utility/LoginManager.php');
require_once('inc/Utility/PDOService.class.php');
require_once('inc/Utility/UserDAO.class.php');

UserDAO::init();

if (isset($_POST['username'])) {
    //user trying to login
    $authUser = UserDAO::getUser($_POST['username']);
    if ($authUser && $authUser->verifyPassWord($_POST['password'])) {
        session_start();

        $_SESSION['username'] = $authUser->getUserName();
    } else {
    }
}
if (LoginManager::verifyLogin()) {
    echo "<h1>user logged in</h1>";
    $user = UserDAO::getUser($_SESSION['username']);

    header("Location: FinalProject_SAo69796.php");
    exit;
} else {
    Page::header();
    Page::showLoginForm();
    Page::footer();
}

?>