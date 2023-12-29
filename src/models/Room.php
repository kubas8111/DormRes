<?php

class Room {
    private $roomID;
    private $roomCode;
    private $dormitoryID;
    private $type;
    private $floor;

    public function __construct($roomID, $roomCode, $dormitoryID, $type, $floor) {
        $this->roomID = $roomID;
        $this->roomCode = $roomCode;
        $this->dormitoryID = $dormitoryID;
        $this->type = $type;
        $this->floor = $floor;
    }

    public function getRoomID() {
        return $this->roomID;
    }

    public function setRoomID($roomID) {
        $this->roomID = $roomID;
    }

    public function getRoomCode() {
        return $this->roomCode;
    }

    public function setRoomCode($roomCode) {
        $this->roomCode = $roomCode;
    }

    public function getDormitoryID() {
        return $this->dormitoryID;
    }

    public function setDormitoryID($dormitoryID) {
        $this->dormitoryID = $dormitoryID;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getFloor() {
        return $this->floor;
    }

    public function setFloor($floor) {
        $this->floor = $floor;
    }
}
