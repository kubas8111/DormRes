<?php
session_start();
$rooms = $_SESSION['code'];
$last = $_SESSION['id'];

// echo $rooms[1]->getAddress();

// foreach($rooms as $gej) {
//     echo $gej->getAddress()."<br>";
// }
echo $last;
echo "<br>dźwik";


//Sprawdzone RoomRepository
//TODO
//RoomRepository->getAvailableRooms(1)

//Sprawdzone DormitoryRepository
//NIE DZIAŁA BO POZMIENIAŁEM CAŁE TE POŁĄCZENIA I GRZYB JEST
