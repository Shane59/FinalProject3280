<?php
require_once('inc/config.inc.php');
require_once('inc/Entity/Page.class.php');
require_once('inc/Entity/Position.class.php');
require_once('inc/Entity/Application.class.php');

require_once('inc/Utility/PDOService.class.php');
require_once('inc/Utility/PositionDAO.class.php');
require_once('inc/Utility/ApplicationDAO.class.php');


PositionDAO::init();
session_start();

if (!isset($_SESSION['username'])) {
  // if not login, send it to login page
  header("Location: Login.php");
  exit;
}
$positions = PositionDAO::getPositions();

if (!empty($_POST) && $_POST['action'] == 'search') {
  echo "<h1>search was invoked</h1>";
  $positions = PositionDAO::getPositionsBySearchValues($_POST['position-name'], $_POST['job-type']);
}

if (isset($_SESSION['admin']) && $_SESSION['admin']) {
  // show admin page
  if (!empty($_GET)) {
    if ($_GET['action'] == 'delete') {
      PositionDAO::deletePosition($_GET['id']);
      header("Location: FinalProject_SAO69796.php");
    }
  }

  //handle post/create
  if (!empty($_POST)) {
    $newPosition = new Position();
    $newPosition->setPositionName($_POST['position-name']);
    $newPosition->setJobType($_POST['job-type']);
    $newPosition->setDatePosted(date('Y-m-d'));
    $newPosition->setJobDescription($_POST['job-description']);
    if (isset($_POST['action']) && $_POST['action'] == 'create') {
      PositionDAO::createPosition($newPosition);
    } else {
      $newPosition->setPositionId($_GET['id']);
      PositionDAO::updatePosition($newPosition);
    }
    header("Location: FinalProject_SAo69796.php"); // avoid resend the same date when refresh the page
  }

  Page::header();
  if (!empty($_GET) && $_GET['action'] == 'edit') {
    $position = PositionDAO::getPosition($_GET['id']);
    Page::editJobPositionForm($position);
  } else {
    Page::createJobPositionForm();
  }
  Page::showPositions($positions);
  Page::footer();

} else {
  ApplicationDAO::init();

  if (empty($_POST) && !empty($_GET['action']) && $_GET['action'] == 'apply-ready') {
    $position = PositionDAO::getPosition($_GET['id']);
    Page::header();
    Page::applyForm($position);
    Page::footer();
    exit;
  }
  echo "<h1>yay</h1>";
  if (!empty($_GET['action']) && $_POST['action'] == 'apply') {
    $newApplication = new Application();
    $newApplication->setUserName($_SESSION['username']);
    $newApplication->setPositionId($_GET['id']);
    $newApplication->setSubmitDate(date('Y-m-d'));
    $newApplication->setStatus("applied");
    $newApplication->setNote($_POST['application-note']);
    ApplicationDAO::createApplication($newApplication);
    header("Location: FinalProject_SAo69796.php");
  }
  Page::header();
  Page::searchForm();
  Page::showAllPositionsForUsers($positions);
  Page::footer();
}
