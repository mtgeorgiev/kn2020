<?php

require_once "Db.php";
require_once "User.php";

class Request {
    
    public static function getOne(string $id): array {

        $user = self::fetchOneFromDb($id, Db::getConnection());
        return [
            'user' => $user,
        ];
    }

    private static function fetchOneFromDb(string $id, $conn): User {

        $sql   = "SELECT * FROM users WHERE id=" . $id;

        $query = $conn->query($sql);

        return User::createFromArray($query->fetch(PDO::FETCH_ASSOC));
    }

    public static function getAll(): array {

        Db::getConnection()->query("set names 'utf8'")->fetch();

        $sql   = "SELECT * FROM users";

        $query = Db::getConnection()->query($sql);

        $users = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $row;
        }

        return [
            'users' => $users
        ];
    }

    public static function create($data): array {

        $conn = Db::getConnection();

        $stmt = $conn->prepare("INSERT INTO users (username, name, age, password)
            VALUES (:username, :name, :age, :password)");

        $insertResult = $stmt->execute([
            'username' => $data['username'],
            'name' => $data['name'],
            'age' => $data['age'],
            'password' => $data['password'],
        ]);

        $errorInfo = null;

        if (!$insertResult) {
            $errorInfo = $stmt->errorInfo();
        }

        return [
            'message' => $insertResult ? 'object created' : 'An error occured. Please try again later.',
            'object' => $data,
            'errorInfo' => $errorInfo,
        ];
    }

    public static function update(string $id, array $data): array {

        $conn = Db::getConnection();

        $dbRecord = self::fetchOneFromDb($id, $conn);
        
        if (!$dbRecord) {
            return [
                'success' => false,
                'errorMessage' => 'User does not exist',
            ];
        }        

        $stmt = $conn->prepare("
            UPDATE users
            SET name = :name, age = :age
            WHERE id = :id");

        $updateInfo = [];
        // $dbRecord was refactored to be an object, so this needs refatoring too
        foreach ($dbRecord as $key => $value) {
            $updateInfo[$key] = isset($data[$key]) ? $data[$key] : $dbRecord[$key];
        }

        $updateResult = $stmt->execute([
            'name' => $updateInfo['name'],
            'age' => $updateInfo['age'],
            'id' => $id,
        ]);

        $errorInfo = null;

        if (!$updateResult) {
            $errorInfo = $stmt->errorInfo();
        }

        return [
            'message' => $updateResult ? 'object updates' : 'An error occured. Please try again later.',
            'object' => $data,
            'errorInfo' => $errorInfo,
        ];

    }

    public static function delete($id): array {
        return [
            'message' => 'object with id ' . $id . ' is deleted'
        ];
    }

}