<?php

class User {
    private $userID;
    private $login;
    private $password;
    private $isAdmin;

    public function __construct(int $userID, string $login, string $password, bool $isAdmin) {
        $this->userID = $userID;
        $this->login = $login;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    public function getUserID(): int {
        return $this->userID;
    }

    public function setUserID(int $userID): void {
        $this->userID = $userID;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function setLogin(string $login): void {
        $this->login = $login;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function isAdmin(): bool {
        return $this->isAdmin;
    }

    public function setAdmin(bool $isAdmin): void {
        $this->isAdmin = $isAdmin;
    }
}