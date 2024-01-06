<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Room.php';

class RoomRepository extends Repository {
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

    public function getAvailableRooms(): array {
        $stmt = $this->database->connect()->prepare('
            SELECT R.*
            FROM Room R
            LEFT JOIN (
                SELECT RoomID, COUNT(*) as reservations_count
                FROM Reservation
                GROUP BY RoomID
            ) Res ON R.RoomID = Res.RoomID
            WHERE Res.reservations_count IS NULL OR Res.reservations_count < R.Type
        ');
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