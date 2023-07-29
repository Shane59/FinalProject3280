<?php

class PositionDAO {
    private static $db;
    
    static function init() {
        self::$db = new PDOService("Position");
    }

    static function getPosition(int $positionId) {
        $select = "SELECT * FROM positions WHERE positionId = :positionId";
        self::$db->query($select);
        self::$db->bind(":positionId", $positionId);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function getPositions() :array {
        $select = "SELECT * FROM positions";
        self::$db->query($select);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function getPositionsBySearchValues($positionName, $jobType) :array {
        $positionNameWhere = "positionName LIKE :positionName";
        $jobTypeWhere = "jobType LIKE :jobType";
        $select = "SELECT * FROM positions WHERE ";
        if ($positionName != "" && $jobType != "") {
            $select .= $positionNameWhere;
            $select .= " AND " . $jobTypeWhere;
            self::$db->query($select);
            self::$db->bind(":positionName", "%" . $positionName . "%");
            self::$db->bind(":jobType", "%" .$jobType . "%");
        } else if ($jobType != "" && $positionName == "") {
            $select .= $jobTypeWhere;
            self::$db->query($select);
            self::$db->bind(":jobType", "%" . $jobType . "%");
        } else if ($positionName != "" && $jobType == "") {
            $select .= $positionNameWhere;
            echo "<p>" . $positionName . "</p>";
            self::$db->query($select);
            self::$db->bind(":positionName", '%' . $positionName . '%');
        }
        if ($positionName == "" && $jobType == "") {
            self::getPositions();
            exit;
        }

        
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function createPosition($newPosition) {
        $insert = "INSERT INTO positions (positionName, datePosted, jobType, JobDescription) VALUES(:positionName, :datePosted, :jobType, :jobDescription)";
        self::$db->query($insert);
        self::$db->bind(":positionName", $newPosition->getPositionName());
        self::$db->bind(":datePosted", $newPosition->getDatePosted());
        self::$db->bind(":jobType", $newPosition->getJobType());
        self::$db->bind(":jobDescription", $newPosition->getJobDescription());
        self::$db->execute();

        return self::$db->lastInsertedId();
    }

    static function updatePosition($position) {
        $update = "UPDATE positions SET positionName = :positionName, jobType = :jobType, jobDescription = :jobDescription WHERE positionId = :positionId";
        // update positions set positionName = "test1234" where positionId = 11;
        self::$db->query($update);
        self::$db->bind(":positionName", $position->getPositionName());
        self::$db->bind(":jobType", $position->getJobType());
        self::$db->bind(":jobDescription", $position->getJobDescription());
        self::$db->bind(":positionId", $position->getPositionId());
        self::$db->execute();

        return self::$db->rowCount();
    }

    static function deletePosition($id) {
        $delete = "DELETE FROM positions WHERE positionId=:id";

        try {
            self::$db->query($delete);
            self::$db->bind(":id", $id);
            self::$db->execute();
            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem occured deleting an position called " . self::getPosition($id)->getPositionName());
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
        return true;
    }
}

?>