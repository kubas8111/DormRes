<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Reservation.php';

class ReservationRepository extends Repository {
    public function getReservation(int $reservationID): ?Reservation {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM Reservation WHERE ReservationID = :reservationID
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
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM Reservation WHERE UserID = :userID LIMIT 1
        ');
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();

        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($reservation === false) {
            return null;
        }

        return new Reservation(
            $reservation['ReservationID'],
            $reservation['UserID'],
            $reservation['RoomID'],
            $reservation['Time']
        );
    }

    public function getReservationDetailsByUserID(int $userID): ?array {
        $stmt = $this->database->connect()->prepare('
            SELECT R.Time, Ro.RoomCode, D.Name as DormitoryName
            FROM Reservation R
            JOIN Room Ro ON R.RoomID = Ro.RoomID
            JOIN Dormitory D ON Ro.DormitoryID = D.DormitoryID
            WHERE R.UserID = :userID
            LIMIT 1
        ');
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();

        $details = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($details === false) {
            return null;
        }

        return $details;
    }

    public function deleteReservation(int $userID): void {
        try {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM Reservation WHERE UserID = :userID
            ');
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error deleting reservation: " . $e->getMessage());
        }
    }
}