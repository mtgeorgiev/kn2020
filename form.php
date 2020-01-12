<?php

// perform authorization and authentication

// 1. authentication
if (!isset($_GET['token'])) {
    // throw bad request exception
}

// if the token from $_GET['token'] is not in the db or is expired - throw not authenticated exception

// if the token is valid, get the user id


// 2. authentication
// check if the user (by the user id we already have) has access to the resource


require_once 'Request.php';

$response = [];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            $response = Request::getOne($_GET['id']);
        } else {
            $response = Request::getAll();
        }
        break;
    case 'POST':
        $rawData = file_get_contents("php://input");
        $formData = json_decode($rawData, true);
        $response = Request::create($formData);
        break;
    case 'PUT':
        $rawData = file_get_contents("php://input");
        $formData = json_decode($rawData, true);
        $response = Request::update($_GET['id'], $formData);
        break;
    case 'DELETE':
        $response = Request::delete($_GET['id']);
        break;
}

echo json_encode($response);

// $rawData = file_get_contents("php://input");

// $formData = json_decode($rawData, true);

// $formData['username'] = $formData['username'] . "111";
// $formData['text'] = htmlentities($formData['text']);

// echo json_encode($formData);


//echo '<p> <sciprt>alert(1)</script> </p>';