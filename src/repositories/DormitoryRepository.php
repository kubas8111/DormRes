<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Dormitory.php';
require_once __DIR__.'/RoomRepository.php';


class DormitoryRepository extends Repository {
    private $roomRepository;
    private $connection;

    public function __construct() {
        parent::__construct();
        $this->roomRepository = new RoomRepository();
        $this->connection = $this->database->connect();
    }
    public function addDormitory(string $address, string $city, string $postcode, string $telephone): void {
        try {
            $stmt = $this->connection->prepare('
                INSERT INTO "Dormitory" ("Address", "City", "Postcode", "Telephone")
                VALUES (:address, :city, :postcode, :telephone)
            ');

            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error adding dormitory: " . $e->getMessage());
        }
    }

    public function deleteDormitory(int $dormitoryID): void {
        try {
            $this->$connection->beginTransaction();
    
            $stmtCheckRooms = $connection->prepare('
                SELECT "RoomID" FROM "Room" WHERE "DormitoryID" = :dormitoryID
            ');
    
            $stmtCheckRooms->bindParam(':dormitoryID', $dormitoryID, PDO::PARAM_INT);
            $stmtCheckRooms->execute();
    
            while ($room = $stmtCheckRooms->fetch(PDO::FETCH_ASSOC)) {
                $this->roomRepository->deleteRoom($room['RoomID']);
            }
    
            $stmtDormitory = $connection->prepare('
                DELETE FROM "Dormitory" WHERE "DormitoryID" = :dormitoryID
            ');
    
            $stmtDormitory->bindParam(':dormitoryID', $dormitoryID, PDO::PARAM_INT);
            $stmtDormitory->execute();
    
            $this->$connection->commit();
        } catch (PDOException $e) {
            $this->$connection->rollBack();
            die("Error deleting dormitory: " . $e->getMessage());
        }
    }
    

    public function getDormitory(int $dormitoryID): ?Dormitory {
        $stmt = $this->connection->prepare('
            SELECT * FROM "Dormitory" WHERE "DormitoryID" = :dormitoryID
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
        $stmt = $this->connection->prepare('
            SELECT * FROM "Dormitory"
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

    public function getLastInsertId(): int {
        return (int) $this->connection->lastInsertId();
    }
}