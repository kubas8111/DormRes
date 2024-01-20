<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Room.php';
require_once __DIR__.'/../repositories/RoomRepository.php';
require_once __DIR__.'/../repositories/DormitoryRepository.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../repositories/UserDataRepository.php';
require_once __DIR__.'/../repositories/ReservationRepository.php';

class DefaultController extends AppController {

    public function main() {
        if(isset($_SESSION['id']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['id']) {
            $this->render('main');
        } else {
            $this->render('login');
        }
    }

    public function login() {
        if(isset($_SESSION['id']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['id']) {
            $this->render('main');
        } else {
            $this->render('login');
        }
    }

    public function information() {
        if(isset($_SESSION['id']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['id']) {
            $this->render('information');
        } else {
            $this->render('login');
        }
    }

    public function reserve() {
        if(isset($_SESSION['id']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['id']) {
            $this->render('reserve');
        } else {
            $this->render('login');
        }
    }

    public function reservation() {
        if(isset($_SESSION['id']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['id']) {
            $this->render('reservation');
        } else {
            $this->render('login');
        }
    }

    public function register() {
        $this->render('register');
    }

    public function test() {
        $roomRepository = new RoomRepository();
        $dormitoryRepository = new DormitoryRepository();
        $userRepository = new UserRepository();
        $userDataRepository = new UserDataRepository();
        $reservationRepository = new ReservationRepository();

        // $dormitoryRepository->addDormitory('dupadupadupa geng', 'karkuw', 'eeedzwig', '+48 111 111 111');
        // $roomRepository->addRoom("DUPA", 7, 2, 3);
        // $roomRepository->addRoom("DUPA1", 7, 1, 3);
        // $roomRepository->addRoom("DUPA2", 7, 1, 3);
        // $roomRepository->addRoom("DUPA3", 7, 2, 3);
        // $roomRepository->deleteRoom(341);
        $dormitoryRepository->deleteDormitory(8);
        // $last = $dormitoryRepository->getLastInsertID();
        session_start();
        
        $rooms = $dormitoryRepository->getDormitories();
        
        $_SESSION['code'] = $rooms;
        $_SESSION['id'] = $last;

        $this->render('dupa');
    }
}