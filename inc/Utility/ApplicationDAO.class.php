<?php

class ApplicationDAO {
  private static $db;
  static function init() {
    self::$db = new PDOService("Application");
  }
  static function createApplication($newApplication) {
    $insert = "INSERT INTO applications VALUES(:userName, :positionId, :submitDate, :status, :note)";
    self::$db->query($insert);
    self::$db->bind(":userName", $newApplication->getUserName());
    self::$db->bind(":positionId", $newApplication->getPositionId());
    self::$db->bind(":submitDate", $newApplication->getSubmitDate());
    self::$db->bind(":status", $newApplication->getStatus());
    self::$db->bind(":note", $newApplication->getNote());
    self::$db->execute();
    return self::$db->lastInsertedId();
  }

  static function getApplications($username) {
    $select = "SELECT a.submitDate, a.status, a.note, a.positionId, ";
    $select .= "p.positionName, p.jobType, p.jobDescription ";
    $select .= "FROM applications a, positions p ";
    $select .= "WHERE a.positionId = p.positionId AND a.username = :username";
    self::$db->query($select);
    self::$db->bind(":username", $username);
    self::$db->execute();
    return self::$db->resultSet();
  }

  static function getApplicationsForAdmin() {
    $select = "SELECT a.submitDate, a.status, a.note, a.positionId, ";
    $select .= "p.positionName, p.jobType, p.jobDescription, u.userName, u.first_name, u.last_name ";
    $select .= "FROM applications a, positions p, users u ";
    $select .= "WHERE a.positionId = p.positionId ";
    $select .= "AND a.username = u.username";
    self::$db->query($select);
    self::$db->execute();
    return self::$db->resultSet();
  }

  static function getApplicationsBySearchValues($username, $positionName, $jobType) {
    $positionNameWhere = " AND positionName LIKE :positionName";
    $jobTypeWhere = " AND jobType LIKE :jobType";
    $select = "SELECT a.submitDate, a.status, a.note, a.positionId, ";
    $select .= "p.positionName, p.jobType, p.jobDescription ";
    $select .= "FROM applications a, positions p ";
    $select .= "WHERE a.positionId = p.positionId AND a.username = :username";

    if ($positionName != "" && $jobType != "") {
      $select .= $positionNameWhere;
      $select .= $jobTypeWhere;
      self::$db->query($select);
      self::$db->bind(":positionName", "%" . $positionName . "%");
      self::$db->bind(":jobType", "%" .$jobType . "%");
      self::$db->bind(":username", $username);
    } else if ($jobType != "" && $positionName == "") {
        $select .= $jobTypeWhere;
        self::$db->query($select);
        self::$db->bind(":jobType", "%" . $jobType . "%");
        self::$db->bind(":username", $username);
    } else if ($positionName != "" && $jobType == "") {
        $select .= $positionNameWhere;
        echo "<p>" . $positionName . "</p>";
        self::$db->query($select);
        self::$db->bind(":positionName", '%' . $positionName . '%');
        self::$db->bind(":username", $username);
    }
    if ($positionName == "" && $jobType == "") {
      self::getApplications($username);
      exit;
    }
    self::$db->execute();
    return self::$db->resultSet();
  }

  static function getApplication($positionId) {
    $select = "SELECT a.submitDate, a.status, a.note, a.positionId, ";
    $select .= "p.positionName, p.jobType, p.jobDescription ";
    $select .= "FROM applications a, positions p ";
    $select .= "WHERE a.positionId = :positionId AND a.username = :username";
    self::$db->query($select);
    self::$db->bind(":username", $_SESSION['username']);
    self::$db->bind(":positionId", $positionId);
    self::$db->execute();
    return self::$db->singleResult();
  }

  static function getApplicationByPositionIdAndUserName($positionId, $userApplied) {
    $select = "SELECT a.submitDate, a.status, a.note, a.positionId, ";
    $select .= "p.positionName, p.jobType, p.jobDescription ";
    $select .= "FROM applications a, positions p, users u ";
    $select .= "WHERE a.positionId = :positionId AND a.username = :userApplied";
    self::$db->query($select);
    self::$db->bind(":userApplied", $userApplied);
    self::$db->bind(":positionId", $positionId);
    self::$db->execute();
    return self::$db->singleResult();
  }

  // update function can only update note of the application
  static function updateApplication($application, $userapplied) {
    $update = "UPDATE applications SET note = :note, status=:status WHERE userName = :userName AND positionId = :positionId";
    self::$db->query($update);
    self::$db->bind(":note", $application->getNote());
    self::$db->bind(":status", $application->getStatus());
    self::$db->bind(":userName", $userapplied);
    self::$db->bind(":positionId", $application->getPositionId());
    self::$db->execute();
    return self::$db->rowCount();
  }

  //delete
  static function deleteApplication($application) {
    $delete = "DELETE FROM applicaitons WHERE userName=:userName AND positionId=:positionId";
    try {
      self::$db->query($delete);
      self::$db->bind(":userName", $_SESSION['username']);
      self::$db->bind(":positionId", $application->getPositionId());
      self::$db->execute();
      if (self::$db->rowCount() != 1) {
        throw new Exception("Problem occured when deleting an application: " . PositionDAO::getPosition($application->getPositionId())->getPositionName());
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      return false;
    }
    return true;
  }
}

?>