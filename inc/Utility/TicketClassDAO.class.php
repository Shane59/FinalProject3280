<?php
/*
+----+------------+--------------+------------+
| ID | TicketCode | TicketDetail | TicketCost |
+----+------------+--------------+------------+
*/
class TicketClassDAO  {

    // Declare static DB member to store the database
    private static $db;

    //Initialize the RoomsTypeDAO
    static function initialize(string $className)    {
        //Remember to send in the class name for this DAO
        self::$db = new PDOService($className);
    }

    //Get all the Ticket Class
    static function getTicketClass(): Array {
        // SELECT statement
        $selectAllTicket = "SELECT * FROM TicketClass";
        // Prepare the Query
        self::$db->query($selectAllTicket);
        // Perform the Query
        self::$db->execute();
        //Return the results
        return self::$db->resultSet();
    }
}


?>