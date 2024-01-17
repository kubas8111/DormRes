<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../models/UserData.php';
require_once __DIR__.'/../repositories/UserDataRepository.php';

class SecurityController extends AppController {
    public function login() {
        $userRepository = new UserRepository();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $userRepository->getUser($email);

        if(!$user) {
            return $this->render("login", ['messages' => ['User with this email doesn\'t exist!']]);
        }

        if(!password_verify($password, $user->getPassword())) {
            return $this->render("login", ['messages' => ['Wrong password!']]);
        }

        $userDataRepository = new UserDataRepository();
        $userData = $userDataRepository->getUserData($user->getUserID());
        
        if($userData) {
            $_SESSION['UserId'] = $userData->getUserID();
            $_SESSION['Name'] = $userData->getName();
            $_SESSION['Surname'] = $userData->getSurname();
            $_SESSION['Telephone'] = $userData->getTelephone();
            $_SESSION['StudentCardID'] = $userData->getStudentCardID();
        }
        
        $_SESSION['UserID'] = $user->getUserID();
        $_SESSION['Email'] = $user->getEmail();
        $_SESSION['Password'] = $user->getPassword();
        $_SESSION['IsAdmin'] = $user->getIsAdmin();

        setcookie("id", $user->getUserId(), time() + 3600, "/");

        
        if($user->getIsAdmin()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");
        } else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");
        }
    }

    public function register() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';
        $telephone = $_POST['telephone'] ?? '';
        $studentCardID = $_POST['studentCardID'] ?? '';

        $userRepository = new UserRepository();
        if ($userRepository->getUser($email)) {
            return $this->render("register", ['messages' => ['User with this email already exists!']]);
        }

        $userRepository->database->beginTransaction();

        try {
            $userRepository->addUser($email, password_hash($password, PASSWORD_DEFAULT), false);
            $userID = $userRepository->getLastInsertId();

            $userDataRepository = new UserDataRepository();
            $userDataRepository->addUserData($userID, $name, $surname, $telephone, $studentCardID);

            $userRepository->database->commitTransaction();
        } catch (PDOException $e) {
            $userRepository->database->rollbackTransaction();
            die("Error registering user: " . $e->getMessage());
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}