<?php

require_once 'AppController.php';

class AdminController extends AppController {
    public function mainAdmin() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            $this->render('mainAdmin');
        } else {
            $this->render('loginPage');
        }
    }

    public function reservationList() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            $this->render('reservationList');
        } else {
            $this->render('loginPage');
        }
    }

    public function users() {
        if(isset($_SESSION['UserId']) && isset($_COOKIE['id']) && $_COOKIE['id'] == $_SESSION['UserId'] && isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']) {
            $this->render('users');
        } else {
            $this->render('loginPage');
        }
    }
}