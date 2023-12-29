<?php

class Reservation {
    private $reservationID;
    private $userID;
    private $roomID;
    private $time;

    public function __construct($reservationID, $userID, $roomID, $time) {
        $this->reservationID = $reservationID;
        $this->userID = $userID;
        $this->roomID = $roomID;
        $this->time = $time;
    }

    public function getReservationID() {
        return $this->reservationID;
    }

    public function setReservationID($reservationID) {
        $this->reservationID = $reservationID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function getRoomID() {
        return $this->roomID;
    }

    public function setRoomID($roomID) {
        $this->roomID = $roomID;
    }

    public function getTime() {
        return $this->time;
    }

    public function setTime($time) {
        $this->time = $time;
    }
}
