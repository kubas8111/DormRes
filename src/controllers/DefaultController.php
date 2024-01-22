<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Room.php';
require_once __DIR__.'/../repositories/RoomRepository.php';
require_once __DIR__.'/../repositories/DormitoryRepository.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../repositories/UserDataRepository.php';
require_once __DIR__.'/../repositories/ReservationRepository.php';

session_start();

class DefaultController extends AppController {
    public function main() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId']) {
            $this->render('main');
        } else {
            $this->render('login');
        }
    }

    public function loginPage() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId']) {
            $this->render('main');
        } else {
            $this->render('login');
        }
    }

    // public function information() {
    //     if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId']) {
    //         $this->render('information');
    //     } else {
    //         $this->render('login');
    //     }
    // }

    public function reserve() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId']) {
            $this->render('reserve');
        } else {
            $this->render('login');
        }
    }

    public function reservation() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId']) {
            $this->render('reservation');
        } else {
            $this->render('login');
        }
    }

    public function registerPage() {
        $this->render('register');
    }

    public function logout() {
        session_destroy();
        setcookie("id", "", time() - 3600, "/");
        $this->render("login");
    }

    public function test() {
        $roomRepository = new RoomRepository();
        $dormitoryRepository = new DormitoryRepository();
        $userRepository = new UserRepository();
        $userDataRepository = new UserDataRepository();
        $reservationRepository = new ReservationRepository();

        // $last = $dormitoryRepository->addDormitory('dupadupadupa geng', 'karkuw', 'eeedzwig', '+48 111 111 111');
        // $roomRepository->addRoom("DUPA", 7, 2, 3);
        // $roomRepository->addRoom("DUPA1", 7, 1, 3);
        // $roomRepository->addRoom("DUPA2", 7, 1, 3);
        // $roomRepository->addRoom("DUPA3", 7, 2, 3);
        // $roomRepository->deleteRoom(341);
        // $dormitoryRepository->deleteDormitory(10);
        // $dormitoryRepository->deleteDormitory(11);
        // $last = $dormitoryRepository->getDormitory(11);

        $passwords = [
            'password1', 'password2', 'password3', 'password4', 'password5',
            'password6', 'password7', 'password8', 'password9', 'password10',
            'password11', 'password12', 'password13', 'password14', 'password15',
            'password16', 'password17', 'password18', 'password19', 'password20'
        ];
        
        $hashedPasswords = [];
        
        foreach ($passwords as $password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $hashedPasswords[] = $hashedPassword;
        }
        
        session_start();
        
        $_SESSION['hashedPasswords'] = $hashedPasswords;
        $rooms = $dormitoryRepository->getDormitories();
        
        $_SESSION['code'] = $rooms;
        // $_SESSION['id'] = $last;
        
        $this->render('dupa');
    }
}