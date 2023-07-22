<?php
require_once('inc/config.inc.php');
require_once('inc/Entity/Page.class.php');

require_once('inc/Utility/PDOService.class.php');



// if (!empty($_GET)) {
//   if ($_GET['action'] == 'delete') {
//     ReservationDAO::deleteReservation($_GET['id']);
//   }
// }

//handle post/create
// if (!empty($_POST)) {
//   $newReservation = new Reservation();
//   $newReservation->setReservationID($_POST['reservationID']);
//   $newReservation->setEmail($_POST['email']);
//   $newReservation->setAmount($_POST['amount']);
//   $newReservation->setTicketClassID($_POST['ticketClassID']);
//   if (isset($_POST['action']) && $_POST['action'] == 'create') {
//     ReservationDAO::createReservation($newReservation);
//   } else {
//     ReservationDAO::updateReservation($newReservation);
//   }
// }

// $ticketClass = TicketClassDAO::getTicketClass();
// $reservations = ReservationDAO::getReservationList();

Page::header();
Page::createJobPositionForm();
Page::listJobApplications();
// Page::listReservations($reservations);
// if (!empty($_GET) && $_GET['action'] == 'edit') {
//   Page::editReservationForm(ReservationDAO::getReservation($_GET['id']),$ticketClass);
// } else {
//   Page::createReservationForm($ticketClass);
// }
Page::footer();

?>