<?php
class Ticket {


/*
+----+------------+--------------+------------+
| ID | TicketCode | TicketDetail | TicketCost |
+----+------------+--------------+------------+
*/
    // Create Class TicketClass
    // Make sure to have only similar attributes with the TicketClass table in the database
    
    //Attributes
    private $ID; // int
    private $TicketCode; //string
    private $TicketDetail; //string
    private $TicketCost; //int

    // And implement only the getter
    // Save your time :)

    //Getters
    function getID(): int {
        return $this->ID;
    }

    function getTicketCode(): string {
        return $this->TicketCode;
    }

    function getTicketDetail(): string {
        return $this->TicketDetail;
    }
    
    function getTicketCost(): int {
        return $this->TicketCost;
    }
}

?>
