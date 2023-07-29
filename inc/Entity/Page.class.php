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
          <div><img src="fakelogo.png" class="logo" alt="logo"></div>
          <ul>
            <?php
            $uri_components = explode("/", $_SERVER['REQUEST_URI']);
            $page = $uri_components[sizeof($uri_components) - 1];

            if ($page == "FinalProject_SAo69796.php") {
              echo "<li><a class=\"active\" href=\"/FinalProject_SAo69796.php\">HOME</a></li>";
            } else {
              echo "<li><a href=\"/FinalProject_SAo69796.php\">HOME</a></li>";
            }
            ?>
            <?php
            if ($page == "Applications.php") {
              echo "<li><a class=\"active\" href=\"Applications.php\">Applications</a></li>";
            } else {
              echo "<li><a href=\"Applications.php\">Applications</a></li>";
            }
            ?>
            <?php
              if (isset($_SESSION['username'])) {
                echo "<li><a href=Logout.php>logout</a></li>";
              } else {
                echo "<li><a href=Login.php>sign in!</a></li>";
              }
            ?>
          </ul>
        </header>
  <?php }

  static function footer()   { ?>
    <!-- Start the page's footer -->            
          </div>
      </body>
    </html>
  <?php }

  // this list is for admins only
  static function showPositions($positions) {
  ?>
  <div>
    <table>
      <tr class="table-header">
        <th>Position Name</th>
        <th>Date Posted</th>
        <th>Job Type</th>
        <th>Job Description</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>
          <?php
            $count = 1;
            foreach($positions as $position) {
              if ($count % 2 != 0) {
                echo "<tr class=\"odd-row\">";
              } else {
                echo "<tr class=\"even-row\">";
              }
              echo "<td>{$position->getPositionName()}</td>";
              echo "<td>{$position->getDatePosted()}</td>";
              echo "<td>{$position->getJobType()}</td>";
              echo "<td>{$position->getJobDescription()}</td>";
              echo "<td><a href={$_SERVER['PHP_SELF']}?action=edit&id={$position->getPositionId()}>Edit</a></td>";
              echo "<td><a href={$_SERVER['PHP_SELF']}?action=delete&id={$position->getPositionId()}>Delete</a></td>";
              echo "</tr>";
              $count++;
            }
          ?>
        </table>
      </div>
    <?php
  }
  
  static function createJobPositionForm()   { ?>        
    <div class="new-entry-form">
      <h2 class="subtitle">Add a new Job Posting!</h2>
      <form action="" method="post">
        <div class="entry-row">
          <div class="entry-col">
            <label for="position-name"></label>
            <input type="text" name="position-name" placeholder="Position Name">
            <select name="job-type" id="">
              <option value="">choose job type</option>
              <option value="full-time">full-time</option>
              <option value="part-time">part-time</option>
              <option value="internship">internship</option>
              <option value="contract">contract</option>
            </select>
          </div>
        </div>
        <div class="entry-row">
          <div class="entry-col textarea-col">
            <label for="job-desciption"></label>
            <textarea name="job-description" cols="80" rows="10" placeholder="Job Description"></textarea>
          </div>
        </div>
        <div class="btn-container">
          <button class="btn-login" type="submit">Add</button>
        </div>
        <input type="hidden" name="action" value="create">
      </form>
    </div>
    <?php
  }

  static function editJobPositionForm($position) {
    ?>        
    <div class="new-entry-form">
      <h2 class="subtitle">Edit a Job Posting!</h2> <?= $position->getJobType()?>
         <form action="" method="post">
             <div class="entry-row">
                 <div class="entry-col">
                     <label for="position-name"></label>
                     <input type="text" name="position-name" placeholder="Position Name" value="<?= $position->getPositionName() ?>">
                     <select name="job-type" id="">
                       <option value="">choose job type</option>
                        <?php
                        $jobTypes = array("full-time", "part-time", "internship", "contract");
                        for ($i = 0; $i < sizeof($jobTypes); $i++) {
                          if ($position->getJobType() == $jobTypes[$i]) {
                            echo "<option selected value=\"{$jobTypes[$i]}\">{$jobTypes[$i]}</option>";    
                          } else {
                            echo "<option value=\"{$jobTypes[$i]}\">{$jobTypes[$i]}</option>";  
                          }
                        }
                      ?>
                    </select>
                 </div>
             </div>
             <div class="entry-row">
                 <div class="entry-col">
                     <label for="job-description"></label>
                     <textarea name="job-description" cols="80" rows="10" placeholder="Job Description"><?= $position->getJobDescription() ?></textarea>
                 </div>
             </div>
             <div class="btn-container">
               <button class="btn-login" type="submit">Edit Position</button>
               <button class="btn-signup"><a href="/FinalProject_SAo69796.php">Back</a></button>
             </div>
         </form>
     </div>
  <?php
  }

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
	static function showApplications($applications) {
    ?>
    <h2>Applications you have applied!</h2>
    <table>
      <p><?= sizeof($applications) ?> applications shown</p>
      <tr class="table-header">
        <th>Position Name</th>
        <th>Job Type</th>
        <th>Job Description</th>
        <th>Status</th>
        <th>Note</th>
        <th>Submit Date</th>
        <th>Edit</th>
      </tr>
      <?php
        $count = 1;
        foreach($applications as $application) {
          if ($count % 2 != 0) {
            echo "<tr class=\"odd-row\">";
          } else {
            echo "<tr class=\"even-row\">";
          }
          echo "<td>{$application->positionName}</td>";
          echo "<td>{$application->jobType}</td>";
          echo "<td>{$application->jobDescription}</td>";
          echo "<td>{$application->getStatus()}</td>";
          echo "<td>{$application->getNote()}</td>";
          echo "<td>{$application->getSubmitDate()}</td>";
          echo "<td><a href={$_SERVER['PHP_SELF']}?action=edit-application&id={$application->getPositionId()}>Edit</a></td>";
          echo "</tr>";
          $count++;
        }
      ?>
    </table>
    <?php
  }

  static function showApplicationsForAdmin($applications) {
    ?>
    <h2>Applications you have applied!</h2>
    <table>
      <p><?= sizeof($applications) ?> applications shown</p>
      <tr class="table-header">
        <th>Position Name</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Job Type</th>
        <th>Job Description</th>
        <th>Status</th>
        <th>Note</th>
        <th>Submit Date</th>
        <th>Edit</th>
      </tr>
      <?php
        $count = 1;
        foreach($applications as $application) {
          if ($count % 2 != 0) {
            echo "<tr class=\"odd-row\">";
          } else {
            echo "<tr class=\"even-row\">";
          }
          echo "<td>{$application->positionName}</td>";
          echo "<td>{$application->first_name}</td>";
          echo "<td>{$application->last_name}</td>";
          echo "<td>{$application->jobType}</td>";
          echo "<td>{$application->jobDescription}</td>";
          echo "<td>{$application->getStatus()}</td>";
          echo "<td>{$application->getNote()}</td>";
          echo "<td>{$application->getSubmitDate()}</td>";
          echo "<td><a href={$_SERVER['PHP_SELF']}?action=edit-application&id={$application->getPositionId()}&userapplied={$application->getUserName()}>Edit</a></td>";
          echo "</tr>";
          $count++;
        }
      ?>
    </table>
    <?php
  }

  static function searchForm() {
    ?>
    <form action="" method="post">
      <div class="entry-row">
        <div class="entry-col">
          <label for="position-name"></label>
          <input type="text" name="position-name" placeholder="Position Name">
        </div>
      </div>
      <div class="entry-row">
        <div class="entry-col">
          <label for="job-type"></label>
          <select name="job-type" id="">
            <option value="">choose job type</option>
            <option value="full-time">full-time</option>
            <option value="part-time">part-time</option>
            <option value="internship">internship</option>
            <option value="contract">contract</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn-search">Search</button>
      <input type="hidden" name="action" value="search">
    </form>
    <?php
  }

  static function showAllPositionsForUsers($positions) {
    ?>
    <div>
      <table>
        <p><?= sizeof($positions) ?> positions available:</p>
        <tr class="table-header">
          <th>Position Name</th>
          <th>Date Posted</th>
          <th>Job Type</th>
          <th>Job Description</th>
          <th>Apply</th>
          </tr>
            <?php
              $count = 1;
              foreach($positions as $position) {
                if ($count % 2 != 0) {
                    echo "<tr class=\"odd-row\">";
                } else {
                  echo "<tr class=\"even-row\">";
                }
                echo "<td>{$position->getPositionName()}</td>";
                echo "<td>{$position->getDatePosted()}</td>";
                echo "<td>{$position->getJobType()}</td>";
                echo "<td>{$position->getJobDescription()}</td>";
                echo "<td><a href={$_SERVER['PHP_SELF']}?action=apply-ready&id={$position->getPositionId()}>Apply</a></td>";
                echo "</tr>";
                $count++;
              }
            ?>
          </table>
        </div>
      <?php
    }

    static function applyForm($position) {
      ?>        
    <div class="new-entry-form">
      <h2 class="subtitle">Apply with some information: </h2>
         <form action="" method="post">
             <div class="entry-row">
                 <div class="entry-col">
                     <div class="apply-form-col">Position Name</div>
                     <div class="apply-form-col-value"><?= $position->getPositionName() ?></div>
                 </div>
                 <div class="entry-col">
                     <div class="apply-form-col">Job Type</div>
                     <div class="apply-form-col-value"><?= $position->getJobType() ?></div>
                 </div>
             </div>
             <div class="entry-row">
               <div class="entry-col">
                    <div class="apply-form-col">Job Description:</div>
                    <div class="apply-form-col-value"><?= $position->getJobDescription() ?></div>
                 </div>
             </div>
             <div class="entry-row">
                 <div class="entry-col">
                     <label for="application-note"></label>
                     <textarea name="application-note" cols="80" rows="10" placeholder="note"></textarea>
                 </div>
             </div>
             <div class="btn-container">
               <button class="btn-login" type="submit">Apply Position</button>
               <input type="hidden" name="action" value="apply">
             </div>
         </form>
     </div>
    <?php
    }

    static function editApplyForm($application) {
      ?>        
    <div class="new-entry-form">
      <h2 class="subtitle">Edit your application: </h2>
         <form action="" method="post">
             <div class="entry-row">
                 <div class="entry-col">
                     <div class="apply-form-col">Position Name</div>
                     <div class="apply-form-col-value"><?= $application->positionName ?></div>
                 </div>
                 <div class="entry-col">
                     <div class="apply-form-col">Job Type</div>
                     <div class="apply-form-col-value"><?= $application->jobType ?></div>
                 </div>
             </div>
             <div class="entry-row">
               <div class="entry-col">
                    <div class="apply-form-col">Job Description:</div>
                    <div class="apply-form-col-value"><?= $application->jobDescription ?></div>
                 </div>
             </div>
             <div class="entry-row">
                 <div class="entry-col">
                     <label for="application-note"></label>
                     <textarea name="application-note" cols="80" rows="10" placeholder="note"><?= $application->getNote() ?></textarea>
                 </div>
             </div>
             <div class="btn-container">
               <input class="btn-login" type="submit">Apply Position</button>
               <input type="hidden" name="action" value="edit-confirm">
             </div>
         </form>
     </div>
    <?php
    }

    static function editApplyFormForAdmin($application) {
      ?>        
    <div class="new-entry-form">
      <h2 class="subtitle">Edit your application: </h2>
         <form action="" method="post">
             <div class="entry-row">
                 <div class="entry-col">
                     <div class="apply-form-col">Position Name</div>
                     <div class="apply-form-col-value"><?= $application->positionName ?></div>
                 </div>
                 <div class="entry-col">
                     <div class="apply-form-col">Job Type</div>
                     <div class="apply-form-col-value"><?= $application->jobType ?></div>
                 </div>
             </div>
             <div class="entry-row">
               <div class="entry-col">
                    <div class="apply-form-col">Job Description:</div>
                    <div class="apply-form-col-value"><?= $application->jobDescription ?></div>
                 </div>
             </div>
             <div class="entry-row">
                 <div class="entry-col">
                     <label for="status"></label>
                     <input type="text" name="status" value="<?= $application->getStatus() ?>">
                 </div>
             </div>
             <div class="btn-container">
               <button class="btn-login" type="submit">Apply Position</button>
               <input type="hidden" name="action" value="edit-confirm">
             </div>
         </form>
     </div>
    <?php
    }
}