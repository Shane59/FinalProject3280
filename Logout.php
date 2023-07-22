<?php
require_once('inc/config.inc.php');
require_once('inc/Entity/User.class.php');
require_once('inc/Entity/Page.class.php');

require_once('inc/Utility/LoginManager.php');
require_once('inc/Utility/PDOService.class.php');
require_once('inc/Utility/UserDAO.class.php');

session_start();

unset($_SESSION);

session_destroy();

header("Location: Login.php");


?>