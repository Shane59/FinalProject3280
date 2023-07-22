<?php

class Page  {

    public static $studentName = "Shinya Aoi";
    public static $studentID = "300369796";

    static function header() { ?>
        <!-- Start the page 'header' -->
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/css/styles.css">
            <title>Document</title>
        </head>
        <body>
            <div class="main-container">
                <header>
                    <div><img src="" alt="logo"></div>
                    <ul>
                        <li><a href="">HOME</a></li>
                        <li><a href="">Applications</a></li>
                        <li><a href="">Companies</a></li>
                    </ul>
                    <?php
                        if (isset($_SESSION['username'])) {
                            echo "<div><a href=\"Logout.php\">logout</a></div>";
                        } else {
                            echo "<div><a href=\"Login.php\">sign in!</a></div>";
                        }
                    ?>
                </header>
    <?php }

    static function footer()   { ?>
        <!-- Start the page's footer -->            
                </div>
            </body>
        </html>
    <?php }

    // This function lists all reservation records
    // The $reservations is the array of Reservation object obtained from the ReservationDAO from the controller
    static function listJobApplications() {
    ?>
    <div>
        <table>
            <tr class="table-header">
                <th>Position Name</th>
                <th>Comapny Name</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Job Type</th>
                <th>Job Description</th>
                <th>Note</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr class="odd-row">
                <td>Jr. Software Developer</td>
                <td>Microsoft</td>
                <td>Tech interview</td>
                <td>6 June, 2023</td>
                <td>Internship</td>
                <td>Develop Microsoft365</td>
                <td>Full-time Internship with paid</td>
                <td><a href="">Edit</a></td>
                <td><a href="">Delete</a></td>
            </tr>
            <tr class="even-row">
                <td>Jr. Software Developer</td>
                <td>Microsoft</td>
                <td>Tech interview</td>
                <td>6 June, 2023</td>
                <td>Internship</td>
                <td>Develop Microsoft365</td>
                <td>Full-time Internship with paid</td>
                <td><a href="">Edit</a></td>
                <td><a href="">Delete</a></td>
            </tr>
        </table>
        </div>
        <?php
    }

    // this function displays the add new reservation record
    // $rooms is the array of rooms objects obtained from the RoomsTypeDAO
    // $rooms is required to display the rooms option
    static function createJobPositionForm()   { ?>        
       <div class="new-entry-form">
            <form action="" method="post">
                <div class="entry-row">
                    <div class="entry-col">
                        <label for="position-name"></label>
                        <input type="text" name="position-name" placeholder="Position Name">
                    </div>
                    <div class="entry-col">
                        <label for="company-phone"></label>
                        <input type="text" name="job-type" placeholder="Job Type">
                    </div>
                </div>
                <div class="entry-row">
                    <div class="entry-col">
                        <label for="date-posted"></label>
                        <input type="text" name="date-posted" placeholder="Date Posted">
                    </div>
                    <div class="entry-col">
                        <label for="company-phone"></label>
                        <input type="text" name="job-description" placeholder="Job Description">
                    </div>
                </div>
                <div class="entry-row">
                    <div class="entry-col">
                        <label for="company-url"></label>
                        <input type="text" name="note" placeholder="Note">
                    </div>
                </div>
            </form>
        </div>
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
		static function showLoginForm() {
			?>
            <div class="login-container">
                <form action="" method="POST">
                    <div class="signin-row">
                        <label for="username"><input name="username" type="text" placeholder="user name"></label>
                    </div>
                    <div class="signin-row">
                        <label for="password"><input name="password" type="password" placeholder="password"></label>
                    </div>
                    <button class="btn-login" type="submit">Login</button>
                    <a href="Signup.php"><button class="btn-signup" type="button">Sign Up</button></a>
                </form>
            </div>
            <?php
		}

        static function showSignupForm() {
			?>
            <div class="login-container">
                <form action="" method="POST">
                    <div class="signin-row">
                        <label for="username"><input name="username" type="text" placeholder="user name"></label>
                    </div>
                    <div class="signin-row">
                        <label for="password"><input name="password" placeholder="password"></label>
                    </div>
                    <div class="signin-row">
                        <label for="firstname"><input name="firstname" placeholder="first name"></label>
                    </div>
                    <div class="signin-row">
                        <label for="lastname"><input name="lastname" placeholder="last name"></label>
                    </div>
                    <button class="btn-login" type="submit">Signup</button>
                    <input type="hidden" name="action" value="signup">
                </form>
            </div>
            <?php
		}


}