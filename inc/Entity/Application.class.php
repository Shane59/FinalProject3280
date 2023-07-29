<?php

class Application {
  private $userName;
  private $positionId;
  private $submitDate;
  private $status;
  private $note;
  public $positionName;
  public $jobType;
  public $jobDescription;
  public $first_name;
  public $last_name;
  
  public function getUserName() {
    return $this->userName;
  }
  public function getPositionId() {
    return $this->positionId;
  }
  public function getSubmitDate() {
    return $this->submitDate;
  }
  public function getStatus() {
    return $this->status;
  }
  public function getNote() {
    return $this->note;
  }
  public function setUserName($userName) {
    $this->userName = $userName;
  }
  public function setPositionId($positionId) {
    $this->positionId = $positionId;
  }
  public function setSubmitDate($submitDate) {
    $this->submitDate = $submitDate;
  }
  public function setStatus($status) {
    $this->status = $status;
  }
  public function setNote($note) {
    $this->note = $note;
  }
}

?>