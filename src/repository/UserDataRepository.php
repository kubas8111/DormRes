<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/UserData.php';

class UserDataRepository extends Repository {
    public function addUserData(int $userID, string $name, string $surname, string $telephone, string $studentCardID): void {
        try {
            $stmt = $this->database->connect()->prepare('
                INSERT INTO UserData (UserID, Name, Surname, Telephone, StudentCardID)
                VALUES (:userID, :name, :surname, :telephone, :studentCardID)
            ');

            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmt->bindParam(':studentCardID', $studentCardID, PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error adding user data: " . $e->getMessage());
        }
    }

    public function deleteUserData(int $userID): void {
        try {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM UserData WHERE UserID = :userID
            ');

            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error deleting user data: " . $e->getMessage());
        }
    }
    
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

    public function getUserDataFromView(int $userID): ?array {
        try {
            $stmt = $this->database->connect()->prepare('
                SELECT * FROM UserDetailsView WHERE UserID = :userID
            ');
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error getting user data from view: " . $e->getMessage());
        }
    }
}