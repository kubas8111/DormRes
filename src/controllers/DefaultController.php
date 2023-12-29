<?php

<<<<<<< HEAD
require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('login', ['message' -> "Hello World!"]);
    }

    public function projects()
    {
        $this->render('projects');
=======
require_once "AppController.php";

class DefaultController extends AppController {
    public function index() {
        $this->render('login');
    }

    public function projects() {
        $this->render('information');
>>>>>>> d27064f49e76d0335c7a4faf191f81190ed0894a
    }
}