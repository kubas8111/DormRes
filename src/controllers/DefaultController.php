<?php

require_once 'AppController.php';

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
}