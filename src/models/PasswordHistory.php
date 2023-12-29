<?php 

class PasswordHistory {
    private $passwordHistory;
    private $userID;
    private $lastPassword;
    private $dateOfChange;

    public function __construct($passwordHistory, $userID, $lastPassword, $dateOfChange) {
        $this->passwordHistory = $passwordHistory;
        $this->userID = $userID;
        $this->lastPassword = $lastPassword;
        $this->dateOfChange = $dateOfChange;
    }

    public function getPasswordHistory() {
        return $this->passwordHistory;
    }

    public function setPasswordHistory($passwordHistory) {
        $this->passwordHistory = $passwordHistory;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function getLastPassword() {
        return $this->lastPassword;
    }

    public function setLastPassword($lastPassword) {
        $this->lastPassword = $lastPassword;
    }

    public function getDateOfChange() {
        return $this->dateOfChange;
    }

    public function setDateOfChange($dateOfChange) {
        $this->dateOfChange = $dateOfChange;
    }
}
