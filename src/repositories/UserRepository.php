<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {
    public function addUser(string $email, string $password, bool $isAdmin = false): int {
        try {
            $connection = $this->database->connect();
            $stmt = $connection->prepare('
                INSERT INTO "User" ("Email", "Password", "isAdmin")
                VALUES (:email, :password, :isAdmin)
            ');

            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':isAdmin', $isAdmin, PDO::PARAM_BOOL);

            $stmt->execute();
            return (int) $connection->lastInsertId();
        } catch (PDOException $e) {
            die("Error adding user: " . $e->getMessage());
        }
    }

    public function deleteUser(int $userID): void {
        try {
            $connection = $this->database->connect();
            $stmt = $connection->prepare('
                DELETE FROM "User" WHERE "UserID" = :userID
            ');

            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error deleting user: " . $e->getMessage());
        }
    }

    public function getUser(string $email): ?User {
        $connection = $this->database->connect();
        $stmt = $connection->prepare('
            SELECT * FROM "User" WHERE "Email" = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false) {
            return null;
        }

        return new User(
            $user['UserID'],
            $user['Email'],
            $user['Password'],
            $user['isAdmin']
        );
    }
}