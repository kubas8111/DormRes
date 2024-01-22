<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('loginPage', 'DefaultController');
Router::get('registerPage', 'DefaultController');
Router::get('reservation', 'DefaultController');
Router::get('reserve', 'DefaultController');
Router::get('main', 'DefaultController');
Router::get('logout', 'DefaultController');

Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');

Router::post('addReservation', 'ReservationController');
Router::post('cancelReservation', 'ReservationController');
Router::post('fetchAvailableRooms', 'ReservationController');

Router::post('addUser', 'UserController');
Router::post('deleteUser', 'UserController');

Router::get('mainAdmin', 'AdminController');
Router::get('reservationList', 'AdminController');
Router::get('users', 'AdminController');


Router::run($path);
