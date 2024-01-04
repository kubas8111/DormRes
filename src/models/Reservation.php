<?php

class Reservation {
    private $reservationID;
    private $userID;
    private $roomID;
    private $time;

    public function __construct(int $reservationID, int $userID, int $roomID, string $time) {
        $this->reservationID = $reservationID;
        $this->userID = $userID;
        $this->roomID = $roomID;
        $this->time = $time;
    }

    public function getReservationID(): int {
        return $this->reservationID;
    }

    public function setReservationID(int $reservationID): void {
        $this->reservationID = $reservationID;
    }

    public function getUserID(): int {
        return $this->userID;
    }

    public function setUserID(int $userID): void {
        $this->userID = $userID;
    }

    public function getRoomID(): int {
        return $this->roomID;
    }

    public function setRoomID(int $roomID): void {
        $this->roomID = $roomID;
    }

    public function getTime(): string {
        return $this->time;
    }

    public function setTime(string $time): void {
        $this->time = $time;
    }
}
