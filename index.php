<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
<<<<<<< HEAD
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('projects', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('addProject', 'ProjectController');

Router::run($path);
=======
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('projects', 'DefaultController');
Routing::run($path);
>>>>>>> d27064f49e76d0335c7a4faf191f81190ed0894a
