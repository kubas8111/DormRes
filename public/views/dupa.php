<?php
session_start();
$rooms = $_SESSION['code'];
// $last = $_SESSION['id'];

// echo $rooms[1]->getAddress();

foreach($rooms as $gej) {
    echo $gej->getDormitoryID()."<br>";
}
// echo $last->getDormitoryID()." <----";
echo "<br>dźwik<br>";

foreach($_SESSION['hashedPasswords'] as $hashedPassword) {
    echo $hashedPassword.'<br>';
}

//Sprawdzone RoomRepository
//TODO
//RoomRepository->getAvailableRooms(1)

//Sprawdzone DormitoryRepository

//
