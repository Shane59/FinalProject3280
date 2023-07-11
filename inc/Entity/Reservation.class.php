<?php

/*
+---------------+------------------+--------+---------------+
| ReservationID | Email            | Amount | TicketClassID |
+---------------+------------------+--------+---------------+
*/
// Create Reservation Class
class Reservation {

    // We need all columns
    // Attributes, make sure they match the column names!    
    private $ReservationID; //string
    private $Email; //string
    private $Amount; //int
    private $TicketClassID; //int

    //Setters. Why do we need setters in this class? create new one
    function setReservationID(string $ReservationID) {
        $this->ReservationID = $ReservationID;
    }

    function setEmail(string $Email) {
        $this->Email = $Email;
    }

    function setAmount(int $Amount) {
        $this->Amount = $Amount;
    }

    function setTicketClassID(int $TicketClassID) {
        $this->TicketClassID = $TicketClassID;
    }

    //Getters
    function getReservationID(): string {
        return $this->ReservationID;
    }

    function getEmail(): string {
        return $this->Email;
    }

    function getAmount(): int {
        return $this->Amount;
    }

    function getTicketClassID(): int {
        return $this->TicketClassID;
    }
}
?>