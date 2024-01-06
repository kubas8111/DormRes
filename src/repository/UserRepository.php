<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {
    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM User WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == false) {
            return null;
        }
        return new User(
            $user['UserID'],
            $user['Email'],
            $user['Password'],
            $user['IsAdmin']
        );
    }

    public function addUser(string $email, string $password, bool $isAdmin = false): void {
        
    }

    public function addUserWithData(string $email, string $password, bool $isAdmin, string $name, string $surname, string $telephone, string $studentCardID): void {
        try {
            $conn = $this->database->connect();
            $conn->beginTransaction();

            $stmtUser = $conn->prepare('
                INSERT INTO "User" (Email, Password, IsAdmin) VALUES (:email, :password, :isAdmin)'
            );
            $stmtUser->bindParam(':email', $email);
            $stmtUser->bindParam(':password', $password);
            $stmtUser->bindParam(':isAdmin', $isAdmin);
            $stmtUser->execute();

            $userID = $conn->lastInsertId();

            $stmtUserData = $conn->prepare(
                'INSERT INTO UserData (UserID, Name, Surname, Telephone, StudentCardID) 
                VALUES (:userID, :name, :surname, :telephone, :studentCardID)');
            $stmtUserData->bindParam(':userID', $userID);
            $stmtUserData->bindParam(':name', $name);
            $stmtUserData->bindParam(':surname', $surname);
            $stmtUserData->bindParam(':telephone', $telephone);
            $stmtUserData->bindParam(':studentCardID', $studentCardID);
            $stmtUserData->execute();

            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            die("Error adding user with data: " . $e->getMessage());
        }
    }
}