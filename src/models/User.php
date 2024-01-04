<?php

class User {
    private $userID;
    private $login;
    private $password;
    private $isAdmin;

    public function __construct($userID, $login, $password, $isAdmin) {
        $this->userID = $userID;
        $this->login = $login;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }
}