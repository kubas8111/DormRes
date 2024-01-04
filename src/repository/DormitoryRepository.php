<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Dormitory.php';

class DormitoryRepository extends Repository {
    public function getDormitory(int $dormitoryID): ?Dormitory {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM Dormitory WHERE DormitoryID = :dormitoryID
        ');
        $stmt->bindParam(':dormitoryID', $dormitoryID, PDO::PARAM_STR);
        $stmt->execute();

        $dormitory = $stmt->fetch(PDO::FETCH_ASSOC);
        if($dormitory == false) {
            return null;
        }
        return new Dormitory(
            $dormitory['DormitoryID'],
            $dormitory['Address'],
            $dormitory['City'],
            $dormitory['Postcode'],
            $dormitory['Telephone']
        );
    }

    public function getDormitories(): array {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM Dormitory
        ');
        $stmt->execute();

        $dormitories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($dormitories as $dormitory) {
            $result[] = new Dormitory(
                $dormitory['DormitoryID'],
                $dormitory['Address'],
                $dormitory['City'],
                $dormitory['Postcode'],
                $dormitory['Telephone']
            );
        }

        return $result;
    }
}