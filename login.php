<?php

$loginData = [];

$loginData = json_decode(file_get_contents("php://input"), true);

// add validation

require_once "Db.php";

$conn = Db::getConnection();

$stmt = $conn->prepare("SELECT * FROM `users` WHERE username = ?");

$stmt->execute([$loginData['username']]);

$dbUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$dbUser = $dbUsers[0];


// when written in the RIGHT way
// if (!password_verify($loginData['password'], $dbUser['password'])) {
//     // return error
// }

// this is the shorter and WRONG one
if (!$dbUser || $dbUser['password'] != $loginData['password']) {
    echo json_encode([
        'success' => false,
    ]);
} else {

    // return token

    $token = hash('sha256', rand() . $dbUser['username'] . time());

    $tokenStmt = $conn->prepare("INSERT INTO `user_tokens` (user_id, token, expires_at)
        VALUES (:user_id, :token, :expires_at)");

    $insertResult = $tokenStmt->execute([
        'user_id' => $dbUser['id'],
        'token' => $token,
        'expires_at' => date("Y-m-d H:i:s", time() + 60 * 60), // token is valid for 1 hour
    ]);

    echo json_encode([
        'success' => true,
        'token' => $token,
    ]);
}
