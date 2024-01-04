<?php

class Dormitory {
    private $dormitoryID;
    private $address;
    private $city;
    private $postcode;
    private $telephone;

    public function __construct(int $dormitoryID, string $address, string $city, string $postcode, string $telephone) {
        $this->dormitoryID = $dormitoryID;
        $this->address = $address;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->telephone = $telephone;
    }

    public function getDormitoryID(): int {
        return $this->dormitoryID;
    }

    public function setDormitoryID(int $dormitoryID): void {
        $this->dormitoryID = $dormitoryID;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }

    public function getPostcode(): string {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): void {
        $this->postcode = $postcode;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }
}
