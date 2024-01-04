<?php

class Room {
    private $roomID;
    private $roomCode;
    private $dormitoryID;
    private $type;
    private $floor;

    public function __construct(int $roomID, string $roomCode, int $dormitoryID, int $type, int $floor) {
        $this->roomID = $roomID;
        $this->roomCode = $roomCode;
        $this->dormitoryID = $dormitoryID;
        $this->type = $type;
        $this->floor = $floor;
    }

    public function getRoomID(): int {
        return $this->roomID;
    }

    public function setRoomID(int $roomID): void {
        $this->roomID = $roomID;
    }

    public function getRoomCode(): string {
        return $this->roomCode;
    }

    public function setRoomCode(string $roomCode): void {
        $this->roomCode = $roomCode;
    }

    public function getDormitoryID(): int {
        return $this->dormitoryID;
    }

    public function setDormitoryID(int $dormitoryID): void {
        $this->dormitoryID = $dormitoryID;
    }

    public function getType(): int {
        return $this->type;
    }

    public function setType(int $type): void {
        $this->type = $type;
    }

    public function getFloor(): int {
        return $this->floor;
    }

    public function setFloor(int $floor): void {
        $this->floor = $floor;
    }
}
