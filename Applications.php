<?php
require_once('inc/config.inc.php');
require_once('inc/Entity/User.class.php');
require_once('inc/Entity/Page.class.php');
require_once('inc/Entity/Position.class.php');
require_once('inc/Entity/Application.class.php');

require_once('inc/Utility/LoginManager.php');
require_once('inc/Utility/PDOService.class.php');
require_once('inc/Utility/UserDAO.class.php');
require_once('inc/Utility/PositionDAO.class.php');
require_once('inc/Utility/ApplicationDAO.class.php');

session_start();

UserDAO::init();
PositionDAO::init();
ApplicationDAO::init();

if (LoginManager::verifyLogin()) {
  $username = $_SESSION['username'];
  if (empty($_POST) && !empty($_GET['action']) && $_GET['action'] == "edit-application") {
    if ($username == "admin") {
      Page::header();
      Page::editApplyFormForAdmin(ApplicationDAO::getApplicationByPositionIdAndUserName($_GET['id'], $_GET['userapplied']));
      Page::footer();
    } else {
      Page::header();
      Page::editApplyForm(ApplicationDAO::getApplication($_GET['id']));
      Page::footer();
    }
    exit;
  }
  if (!empty($_POST) && $_POST['action'] == "edit-confirm") {
    if ($username == "admin") {
      $application = ApplicationDAO::getApplicationByPositionIdAndUserName($_GET['id'], $_GET['userapplied']);
      $application->setStatus($_POST['status']);
      ApplicationDAO::updateApplication($application, $_GET['userapplied']);
    } else {
      $application = ApplicationDAO::getApplication($_GET['id']);
      $application->setNote($_POST['application-note']);
      ApplicationDAO::updateApplication($application, $username);
    }
    header("Location: Applications.php");
  }
  $applications = ApplicationDAO::getApplications($username);
  if ($username == "admin") {
    $applications = ApplicationDAO::getApplicationsForAdmin();
  }
  if (!empty($_POST) && $_POST['action'] == "search") {
    $applications = ApplicationDAO::getApplicationsBySearchValues($username, $_POST['position-name'], $_POST['job-type']);
    
  }
  Page::header();
  Page::searchForm();
  if ($username == "admin") {
    Page::showApplicationsForAdmin($applications);
  } else {
    Page::showApplications($applications);
  }
  Page::footer();
} else {
  header("Location: Login.php");
}

?>