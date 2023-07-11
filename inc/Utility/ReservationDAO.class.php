<?php


/*
+---------------+------------------+--------+---------------+
| ReservationID | Email            | Amount | TicketClassID |
+---------------+------------------+--------+---------------+
*/

class ReservationDAO  {
    private static $db;

    static function initialize(string $className)    {
        self::$db = new PDOService($className);
    }

    static function createReservation(Reservation $newReservation) {
        $insertReservation = "INSERT INTO Reservation ";
        $insertReservation .= "(ReservationID, Email, Amount, TicketClassID) ";
        $insertReservation .= "VALUES(:reservationId, :email, :amount, :ticketClassId)";

        self::$db->query($insertReservation);
        self::$db->bind(":reservationId", $newReservation->getReservationId());
        self::$db->bind(":email", $newReservation->getEmail());
        self::$db->bind(":amount", $newReservation->getAmount());
        self::$db->bind(":ticketClassId", $newReservation->getTicketClassId());

        self::$db->execute($insertReservation);
        return self::$db->lastInsertedId();
    }
    
    static function getReservation(string $ReservationID) : Reservation {
       $selectReservation = "SELECT * FROM Reservation WHERE reservationId=:reservationId";

       self::$db->query($selectReservation);
       self::$db->bind(":reservationId", $ReservationID);
       self::$db->execute();
       return self::$db->singleResult();
    }

    static function getReservations() : Array {
        $selectReservations = "SELECT * FROM Reservation";
        self::$db->query($selectReservations);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function updateReservation (Reservation $ReservationToUpdate) : int {
        $updateReservation = "UPDATE Reservation SET Email=:email, Amount=:amount, ";
        $updateReservation .= "TicketClassId=:ticketClassId WHERE ReservationId=:reservationId";

        self::$db->query($updateReservation);
        self::$db->bind(":email", $ReservationToUpdate->getEmail());
        self::$db->bind(":amount", $ReservationToUpdate->getAmount());
        self::$db->bind(":ticketClassId", $ReservationToUpdate->getTicketClassId());
        self::$db->bind(":reservationId", $ReservationToUpdate->getReservationId());

        self::$db->execute();
        return self::$db->rowCount();

    }
    
    static function deleteReservation(string $ReservationId) : int {
        $deleteReservation = "DELETE FROM Reservation WHERE ReservationId=:reservationId";
        self::$db->query($deleteReservation);
        self::$db->bind(":reservationId", $ReservationId);
        self::$db->execute();
        return self::$db->rowCount();
    }

    static function getReservationList() : Array {
        $selectReservationList = "SELECT R.ReservationID, R.Email, R.Amount, T.TicketDetail, R.TicketClassID, ";
        $selectReservationList .= "T.TicketCost FROM Reservation R, TicketClass T WHERE ";
        $selectReservationList .= "R.TicketClassID=T.Id";
        self::$db->query($selectReservationList);
        self::$db->execute();
        return self::$db->resultSet();
    }

}


?>