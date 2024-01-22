<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Reservation.php';
require_once __DIR__.'/../repositories/ReservationRepository.php';
require_once __DIR__.'/../models/Room.php';
require_once __DIR__.'/../repositories/RoomRepository.php';

class ReservationController extends AppController {
    public function addReservation() {
        session_start();

        $roomID = (int) $_POST['room'];

        if(!isset($_SESSION['UserID'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/loginPage");
            exit();
        }

        $userID = $_SESSION['UserID'];

        $reservationRepository = new ReservationRepository();
        $reservationRepository->addReservation($userID, $roomID);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/reservation");
    }

    public function cancelReservation() {
        try {
            session_start();
            $userID = $_SESSION['UserID'];

            $reservationRepository = new ReservationRepository();

            $reservationRepository->deleteReservation($userID);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/reservation");

        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function fetchAvailableRooms() {
        $dormitoryID = $_POST['dormitoryID'];
    
        $roomRepository = new RoomRepository();
        $availableRooms = $roomRepository->getAvailableRooms($dormitoryID);

        //$response = ["message" => "success", "rooms" => $availableRooms];

        echo json_encode($availableRooms);
    }
}