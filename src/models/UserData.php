<?php

class UserData { 
    private $userID;
    private $name;
    private $surname;
    private $telephone;
    private $studentCardID;

    public function __construct(int $userID, string $name, string $surname, string $telephone, string $studentCardID) {
        $this->userID = $userID;
        $this->name = $name;
        $this->surname = $surname;
        $this->telephone = $telephone;
        $this->studentCardID = $studentCardID;
    }

    public function getUserID(): int {
        return $this->userID;
    }

    public function setUserID(int $userID): void {
        $this->userID = $userID;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }

    public function getStudentCardID(): string {
        return $this->studentCardID;
    }

    public function setStudentCardID(string $studentCardID): void {
        $this->studentCardID = $studentCardID;
    }
}
