<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/UserData.php';

class UserDataRepository extends Repository {
    public function getUserData(string $userID): ?UserData {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM User WHERE email = :userID
        ');
        $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == false) {
            return null;
        }
        return new UserData(
        );
    }

    public function addUserData(string $email, string $password): void {
        
    }
}