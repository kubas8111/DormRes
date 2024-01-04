<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/UserData.php';

class UserDataRepository extends Repository {
    public function getUserData(int $userID): ?UserData {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM UserData WHERE UserID = :userID
        ');
        $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData == false) {
            return null;
        }
        return new UserData(
            $userData['UserID'],
            $userData['Name'],
            $userData['Surname'],
            $userData['Telephone'],
            $userData['StudentCardID']
        );
    }

    public function addUserData(string $email, string $password): void {
        
    }
}