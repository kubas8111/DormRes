<?php

require_once 'AppController.php';

session_start();

class AdminController extends AppController {
    public function mainAdmin() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId'] && isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin']) {
            $this->render('mainAdmin');
        } else {
            $this->render('login');
        }
    }

    public function reservationList() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId'] && isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin']) {
            $this->render('reservationList');
        } else {
            $this->render('login');
        }
    }

    public function users() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId'] && isset($_SESSION['IsAdmin']) && $_SESSION['IsAdmin']) {
            $this->render('users');
        } else {
            $this->render('login');
        }
    }
}