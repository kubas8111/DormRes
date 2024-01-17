<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Room.php';

class RoomRepository extends Repository {
    public function addRoom(string $roomCode, int $dormitoryID, int $type, int $floor): void {
        try {
            $stmt = $this->database->connect()->prepare('
                INSERT INTO Room (RoomCode, DormitoryID, Type, Floor)
                VALUES (:roomCode, :dormitoryID, :type, :floor)
            ');

            $stmt->bindParam(':roomCode', $roomCode, PDO::PARAM_STR);
            $stmt->bindParam(':dormitoryID', $dormitoryID, PDO::PARAM_INT);
            $stmt->bindParam(':type', $type, PDO::PARAM_INT);
            $stmt->bindParam(':floor', $floor, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error adding room: " . $e->getMessage());
        }
    }

    public function deleteRoom(int $roomID): void {
        try {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM Room WHERE RoomID = :roomID
            ');

            $stmt->bindParam(':roomID', $roomID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error deleting room: " . $e->getMessage());
        }
    }

    public function getRoom(int $roomID): ?Room {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM Room WHERE RoomID = :roomID
        ');
        $stmt->bindParam(':roomID', $roomID, PDO::PARAM_STR);
        $stmt->execute();

        $room = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($room == false) {
            return null;
        }
        return new Room(
            $room['RoomID'],
            $room['RoomCode'],
            $room['DormitoryID'],
            $room['Type'],
            $room['Floor']
        );
    }

    public function getRoomsByDormitoryID(int $dormitoryID): array {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM Room WHERE DormitoryID = :dormitoryID
        ');
        $stmt->bindParam(':dormitoryID', $dormitoryID, PDO::PARAM_INT);
        $stmt->execute();

        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rooms as $room) {
            $result[] = new Room(
                $room['RoomID'],
                $room['RoomCode'],
                $room['DormitoryID'],
                $room['Type'],
                $room['Floor']
            );
        }

        return $result;
    }

    public function getAvailableRooms(int $dormitoryID): array {
        $stmt = $this->database->connect()->prepare('
            SELECT R.*
            FROM Room R
            LEFT JOIN (
                SELECT RoomID, COUNT(*) as reservations_count
                FROM Reservation
                GROUP BY RoomID
            ) Res ON R.RoomID = Res.RoomID
            WHERE R.DormitoryID = :dormitoryID
            AND (Res.reservations_count IS NULL OR Res.reservations_count < R.Type)
        ');

        $stmt->bindParam(':dormitoryID', $dormitoryID, PDO::PARAM_INT);
        $stmt->execute();

        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($rooms as $room) {
            $result[] = new Room(
                $room['RoomID'],
                $room['RoomCode'],
                $room['DormitoryID'],
                $room['Type'],
                $room['Floor']
            );
        }

        return $result;
    }
}