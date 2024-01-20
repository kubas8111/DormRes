<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {
    public function addUser(string $email, string $password, bool $isAdmin = false): void {
        try {
            $stmt = $this->database->connect()->prepare('
                INSERT INTO "User" ("Email", "Password", "IsAdmin")
                VALUES (:email, :password, :isAdmin)
            ');

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':isAdmin', $isAdmin, PDO::PARAM_BOOL);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error adding user: " . $e->getMessage());
        }
    }

    public function getLastInsertId(): int {
        return (int) $this->database->connect()->lastInsertId();
    }

    public function deleteUser(int $userID): void {
        try {
            $stmt = $this->database->connect()->prepare('
                DELETE FROM "User" WHERE UserID = :userID
            ');

            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error deleting user: " . $e->getMessage());
        }
    }

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

    // public function addUserWithData(string $email, string $password, bool $isAdmin, string $name, string $surname, string $telephone, string $studentCardID): void {
    //     try {
    //         $conn = $this->database->connect();
    //         $conn->beginTransaction();

    //         $stmtUser = $conn->prepare('
    //             INSERT INTO "User" (Email, Password, IsAdmin) VALUES (:email, :password, :isAdmin)'
    //         );
    //         $stmtUser->bindParam(':email', $email);
    //         $stmtUser->bindParam(':password', $password);
    //         $stmtUser->bindParam(':isAdmin', $isAdmin);
    //         $stmtUser->execute();

    //         $userID = $conn->lastInsertId();

    //         $stmtUserData = $conn->prepare(
    //             'INSERT INTO UserData (UserID, Name, Surname, Telephone, StudentCardID) 
    //             VALUES (:userID, :name, :surname, :telephone, :studentCardID)');
    //         $stmtUserData->bindParam(':userID', $userID);
    //         $stmtUserData->bindParam(':name', $name);
    //         $stmtUserData->bindParam(':surname', $surname);
    //         $stmtUserData->bindParam(':telephone', $telephone);
    //         $stmtUserData->bindParam(':studentCardID', $studentCardID);
    //         $stmtUserData->execute();

    //         $conn->commit();
    //     } catch (PDOException $e) {
    //         $conn->rollBack();
    //         die("Error adding user with data: " . $e->getMessage());
    //     }
    // }

    // public function deleteUser(int $userID): void {
    //     try {
    //         $this->database->connect()->beginTransaction();

    //         $stmtUser = $this->database->connect()->prepare('
    //             DELETE FROM "User" WHERE UserID = :userID
    //         ');

    //         $stmtUser->bindParam(':userID', $userID, PDO::PARAM_INT);
    //         $stmtUser->execute();

    //         $stmtUserData = $this->database->connect()->prepare('
    //             DELETE FROM UserData WHERE UserID = :userID
    //         ');

    //         $stmtUserData->bindParam(':userID', $userID, PDO::PARAM_INT);
    //         $stmtUserData->execute();

    //         $this->database->connect()->commit();
    //     } catch (PDOException $e) {
    //         $this->database->connect()->rollBack();
    //         die("Error deleting user: " . $e->getMessage());
    //     }
    // }
}