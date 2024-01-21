<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('loginPage', 'DefaultController');
Router::get('registerPage', 'DefaultController');
Router::get('reservation', 'DefaultController');
Router::get('information', 'DefaultController');
Router::get('reserve', 'DefaultController');
Router::get('main', 'DefaultController');

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');

Router::post('addReservation', 'ReservationController');
Router::post('cancelReservation', 'ReservationController');

Router::post('addUser', 'UserController');
Router::post('deleteUser', 'UserController');

Router::post('test', 'DefaultController');


Router::run($path);
