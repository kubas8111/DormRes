<?php

class Dormitory {
    private $dormitoryID;
    private $address;
    private $city;
    private $postcode;
    private $telephone;

    public function __construct($dormitoryID, $address, $city, $postcode, $telephone) {
        $this->dormitoryID = $dormitoryID;
        $this->address = $address;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->telephone = $telephone;
    }

    public function getDormitoryID() {
        return $this->dormitoryID;
    }

    public function setDormitoryID($dormitoryID) {
        $this->dormitoryID = $dormitoryID;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function setPostcode($postcode) {
        $this->postcode = $postcode;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }
}
