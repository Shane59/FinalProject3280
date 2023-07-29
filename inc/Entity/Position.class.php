<?php

class Position {
    private $positionId;
    private $positionName;
    private $datePosted;
    private $jobType;
    private $jobDescription;

    public function getPositionId() {
        return $this->positionId;
    }
    public function getPositionName() {
        return $this->positionName;
    }
    public function getDatePosted() {
        return $this->datePosted;
    }
    public function getJobType() {
        return $this->jobType;
    }
    public function getJobDescription() {
        return $this->jobDescription;
    }
    public function setPositionId($id) {
        $this->positionId = $id;
    }
    public function setPositionName($positionName) {
        $this->positionName = $positionName;
    }
    public function setDatePosted($date) {
        $this->datePosted = $date;
    }
    public function setJobType($jobType) {
        $this->jobType = $jobType;
    }
    public function setJobDescription($desc) {
        $this->jobDescription = $desc;
    }
}

?>