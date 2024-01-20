<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Reservation.php';
require_once __DIR__.'/../repositories/ReservationRepository.php';
require_once __DIR__.'/../models/Room.php';
require_once __DIR__.'/../repositories/RoomRepository.php';

class ReservationController extends AppController {
    public function addReservation() {
        session_start();

        $dormitoryID = $_POST['dormitoryID'] ?? 0;
        $roomID = $_POST['roomID'] ?? 0;

        if(!isset($_SESSION['UserID'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
            exit();
        }

        $userID = $_SESSION['UserID'];

        $roomRepository = new RoomRepository();
        $availableRooms = $roomRepository->getAvailableRooms($dormitoryID);

        if(!in_array($roomID, $availableRooms)) {
            return $this->render("reservation", ['messages' => ['Selected room is not available']]);
        }

        $reservationRepository = new ReservationRepository();
        $reservationRepository->addReservation($userID, $roomID);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");
    }

    public function cancelReservation() {
        try {
            session_start();
            $userID = $_SESSION['UserID'];

            $reservationRepository = new ReservationRepository();

            $reservationRepository->deleteReservation($userID);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");

        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function fetchAvailableRooms() {
        $dormitoryID = $_GET['dormitoryID'];
    
        $roomRepository = new RoomRepository();
        $availableRooms = $roomRepository->getAvailableRooms($dormitoryID);
    
        $options = '';
        foreach ($availableRooms as $room) {
          $options .= '<option value="' . $room->getRoomID() . '">' . $room->getRoomCode() . '</option>';
        }
    
        echo $options;
      }
}