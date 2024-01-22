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
}