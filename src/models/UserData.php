<?php

class UserData { 
    private $userID;
    private $name;
    private $surname;
    private $telephone;
    private $email;
    private $studentCardID;

    public function __construct($userID, $name, $surname, $telephone, $email, $studentCardID) {
        $this->userID = $userID;
        $this->name = $name;
        $this->surname = $surname;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->studentCardID = $studentCardID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getStudentCardID() {
        return $this->studentCardID;
    }

    public function setStudentCardID($studentCardID) {
        $this->studentCardID = $studentCardID;
    }
}
