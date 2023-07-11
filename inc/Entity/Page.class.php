<?php

# Make sure to :
# 1. Edit the studentName and studentID
# 2. Edit the page's meta author and title
# 3. Edit the page's main heading to use the static member
# 4. Complete the listReservations(), addReservationForm() and editReservationForm()

class Page  {

    public static $studentName = "Shinya Aoi";
    public static $studentID = "300369796";

    static function header()   { ?>
        <!-- Start the page 'header' -->
        <!DOCTYPE html>
        <html>
            <head>
                <title></title>
                <meta charset="utf-8">
                <meta name="author" content="">
                <title>Resrevation Form</title>   
                <link href="css/stylesA.css" rel="stylesheet">     
            </head>
            <body>
                <header>
                <h1>Assignment 03: PDO CRUD with DAO -- <?= self::$studentName ?> (<?= self::$studentID ?>)</h1>
                </header>
                <article>
    <?php }

    static function footer()   { ?>
        <!-- Start the page's footer -->            
                </article>
            </body>
        </html>
    <?php }

    // This function lists all reservation records
    // The $reservations is the array of Reservation object obtained from the ReservationDAO from the controller
    static function listReservations(Array $reservations)    {
    ?>
        <!-- Start the page's show data form -->
        <section class="main">
        <h2>Current Data</h2>
        <table id="list">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <!-- Complete the remaining header --> 
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Ticket Class</th>
                    <th>Cost</th>
                    <th>Edit</th>
                    <th>Delete</th>
            </thead>
            <?php
                $i=0;
                foreach($reservations as $reservation)  {
                    if ($i % 2 == 0) {
                        echo "<tbody class='evenRow'>";
                    } else {
                        echo "<tbody>";
                    }
                    $totalCost = $reservation->TicketCost * $reservation->getAmount();
                    echo "<tr>";
                    echo "<td>{$reservation->getReservationID()}</td>";
                    echo "<td>{$reservation->getEmail()}</td>";
                    echo "<td>{$reservation->getAmount()}</td>";
                    echo "<td>{$reservation->TicketDetail}</td>";
                    echo "<td>\${$totalCost}</td>";
                    echo "<td><a href={$_SERVER['PHP_SELF']}?action=edit&id={$reservation->getReservationID()}>Edit</td>";
                    echo "<td><a href={$_SERVER['PHP_SELF']}?action=delete&id={$reservation->getReservationID()}>Delete</td>";
                    echo "</tr>";
                    echo "</tbody>";
                    $i++;
                } 
        
        echo '</table>
            </section>';
  
    }

    // this function displays the add new reservation record
    // $rooms is the array of rooms objects obtained from the RoomsTypeDAO
    // $rooms is required to display the rooms option
    static function createReservationForm(Array $ticketClass)   { ?>        
        <!-- Start the page's add entry form -->
        <section class="form1">
                <h3>Add a New Reservation</h3>
                <!-- make sure to edit the form action -->
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <table>
                        <tr>
                            <td>Reservation ID</td>
                            <td><input type="text" name="reservationID" id="reservationID" placeholder="R{X|Y}XXX"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" id="email" placeholder="someone@here.com"></td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td><input type="text" name="amount" id="amount" placeholder="1 to 5"></td>
                        </tr>                                                
                        <tr>
                            <td>Ticket Class</td>
                            <td>
                            <select name="ticketClassID">
                            <?php
                                // use loop to list all TicketDetail here
                                // from the database to display the html's option elements
                                foreach($ticketClass as $class) {
                                    echo "<option value='{$class->getID()}'>{$class->getTicketDetail()}</option>";
                                }
                            ?>
                            </select>
                            </td>
                        </tr>
                    </table>
                    <!-- Use input type hidden to let us know that this action is to create record -->
                    <input type="hidden" name="action" value="create">
                    <input type="submit" value="Add Reservation">
                </form>
            </section>

    <?php }

    // This function is to show the edit reservation record form
    // The edit form should be displayed only when the Edit link is clicked
    // Whether you will display add form or edit form should be controlled in the main file.

    // The $reservationToEdit is a singleResult record of reservation whose link was clicked
    // The $ticketClass contains the array of ticket objects from the TicketClassDAO
    static function editReservationForm(Reservation $reservationToEdit, Array $ticketClass)   {  
        ?>        
        <!-- Start the page's edit entry form -->
        <section class="form1">
            <h3>Edit Reservation - <?php // I should echo something here ?></h3>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <table>
                    <tr>
                        <td>Reservation ID</td>
                        <td><?= $reservationToEdit->getReservationID() ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" id="email" value="<?= $reservationToEdit->getEmail() ?>"></td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td><input type="text" name="amount" id="amount" value="<?= $reservationToEdit->getAmount() ?>"></td>
                    </tr>                
                    <tr>
                        <td>Ticket Class</td>
                        <td>
                        <select name="ticketClassID">
                        <?php
                                foreach($ticketClass as $class) {
                                    if ($reservationToEdit->getTicketClassID() == $class->getID()) {
                                        echo "<option selected value='{$class->getID()}'>{$class->getTicketDetail()}</option>";
                                    } else {
                                        echo "<option value='{$class->getID()}'>{$class->getTicketDetail()}</option>";
                                    }
                                }
                            ?>
                        </select>
                        </td>
                    </tr>
                </table>              
                <input type="hidden" name="reservationID" value="<?= $reservationToEdit->getReservationID(); ?>">
                <input type="hidden" name="action" value="edit">
                <input type="submit" value="Edit Reservation">                
            </form>
        </section>

<?php }

}