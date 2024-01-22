<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Reservation.php';

class ReservationRepository extends Repository {
    public function addReservation(int $userID, int $roomID): void {
        try {
            $connection = $this->database->connect();
            $stmt = $connection->prepare('
            INSERT INTO "Reservation" ("UserID", "RoomID")
            VALUES (:userID, :roomID)
            ');
            
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->bindParam(':roomID', $roomID, PDO::PARAM_INT);
            
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error adding reservation: " . $e->getMessage());
        }
    }
    
    public function deleteReservation(int $userID): void {
        try {
            $connection = $this->database->connect();
            $stmt = $connection->prepare('
                DELETE FROM "Reservation" WHERE "UserID" = :userID
            ');
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error deleting reservation: " . $e->getMessage());
        }
    }

    public function getReservation(int $reservationID): ?Reservation {
        $connection = $this->database->connect();
        $stmt = $connection->prepare('
            SELECT * FROM "Reservation" WHERE "ReservationID" = :reservationID
        ');
        $stmt->bindParam(':reservationID', $reservationID, PDO::PARAM_STR);
        $stmt->execute();

        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
        if($reservation == false) {
            return null;
        }
        return new Reservation(
            $reservation['ReservationID'],            
            $reservation['UserID'],
            $reservation['RoomID'],
            $reservation['Time']
        );
    }

    public function getReservationByUserID(int $userID): ?Reservation {
        $connection = $this->database->connect();
        $stmt = $connection->prepare('
            SELECT * FROM "Reservation" WHERE "UserID" = :userID
        ');
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();

        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($reservation === false) {
            return null;
        }

        return $reservation;
        // return new Reservation(
        //     $reservation['ReservationID'],
        //     $reservation['UserID'],
        //     $reservation['RoomID'],
        //     $reservation['Time']
        // );
    }

    public function getReservationDetailsByUserID(int $userID): ?array {
        $connection = $this->database->connect();
        $stmt = $connection->prepare('
            SELECT TO_CHAR(R."Time", \'YYYY-MM-DD HH24:MI:SS\') as FormattedTime,
            Ro."Roomcode",
            D."Address" as DormitoryName
            FROM "Reservation" R
                JOIN "Room" Ro ON R."RoomID" = Ro."RoomID"
                JOIN "Dormitory" D ON Ro."DormitoryID" = D."DormitoryID"
            WHERE R."UserID" = :userID
            LIMIT 1;
        ');
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();

        $details = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($details === false) {
            return null;
        }

        return $details;
    }

    public function getReservationView(): ?array {
        $connection = $this->database->connect();
        $stmt = $connection->prepare('
            SELECT * FROM "ReservationDetails"
        ');
        $stmt->execute();

        $reservation = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($reservation === false) {
            return null;
        }
        
        return $reservation;
    }
}