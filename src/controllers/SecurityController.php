<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';

require_once __DIR__.'/../repositories/UserDataRepository.php';

class SecurityController extends AppController {
    public function login() {
        $userRepository = new UserRepository();
        $login = $_POST["login"];
        $password = $_POST["password"];
        $user = $userRepository->getUser($login);

        if(!$user) {
            return $this->render("login", ['messages' => ['User with this email doesn\'t exist!']]);
        }

        if(!password_verify($password, $user->getPassword())) {
            return $this->render("login", ['messages' => ['Wrong password!']]);
        }

        $userDataRepository = new UserDataRepository();
        $userData = $userDataRepository->getUserData($user->getUserID());

        // -----------------------
        $_SESSION["UserID"] = $user->getId();
        $_SESSION["nickname"] = $user->getNickname();
        $_SESSION["email"] = $user->getEmail();
        $_SESSION["password"] = $user->getPassword();

        setcookie("id", $user->getUserId(), time() + 3600, "/");

        if($userData != null) {
            $_SESSION["userData"] = $userData->();
            $_SESSION["userData"] = $userData->();
            $_SESSION["userData"] = $userData->();
            $_SESSION["userData"] = $userData->();
            $_SESSION["userData"] = $userData->();
        }
        

        if($user->getIsAdmin()) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");
        } else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");
        }
        //---------------------------
    }

    public function register() {
        $userRepository = new UserRepository();

        // do wyrzucenia, bo źle, znowu zmieniać trzeba wzsystko, najpierw od bazy trzeba zacząć
        if($userRepository->getUser($_POST['login']) != null) {
            return $this->render("register", ['messages' => ['User with this login already exists!']]);
        }

        if($userRepository->getUser($_POST['login']) != null) {
            return $this->render("register", ['messages' => ['User with this login already exists!']]);
        }

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if($userRepository->addUser($_POST['login'], $hashedPassword, $_POST['email'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");
        } else {
            return $this->renderView("register", ['messages' => ['Something went wrong!']]);
        }
    }
}