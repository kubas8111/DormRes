<?php

class User {
    private $userID;
    private $email;
    private $password;
    private $isAdmin;

    public function __construct(int $userID, string $email, string $password, bool $isAdmin) {
        $this->userID = $userID;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    public function getUserID(): int {
        return $this->userID;
    }

    public function setUserID(int $userID): void {
        $this->userID = $userID;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getIsAdmin(): bool {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void {
        $this->isAdmin = $isAdmin;
    }
}
