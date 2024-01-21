<?php

require_once 'AppController.php';

require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserData.php';

require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../repositories/UserDataRepository.php';

class UserController extends AppController {
    public function addUser() {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $telephone = $_POST['telephone'];
            $studentCardID = $_POST['studentCardID'];
    
            $userRepository = new UserRepository();
            $userDataRepository = new UserDataRepository();
    
            $userID = $userRepository->addUser($email, $password);
            $userDataRepository->addUserData($userID, $name, $surname, $telephone, $studentCardID);
        } catch (PDOException $e) {
            die("Error adding user with data: " . $e->getMessage());
        }
    }

    public function deleteUser() {
        try {
            session_start();
            $userID = $_SESSION['userID'];
    
            // $userID = 4;

            $userRepository = new UserRepository();
            $userDataRepository = new UserDataRepository();
    
            $userDataRepository->deleteUserData($userID);
    
            $userRepository->deleteUser($userID);
        } catch (PDOException $e) {
            die("Error deleting user: " . $e->getMessage());
        }
    }
}