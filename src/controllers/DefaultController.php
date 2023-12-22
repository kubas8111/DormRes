<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('login', ['message' -> "Hello World!"]);
    }

    public function projects()
    {
        $this->render('projects');
    }
}