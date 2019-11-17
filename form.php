<?php

require_once 'Request.php';

$response = [];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $response = Request::get();
        break;
    case 'POST':
        $rawData = file_get_contents("php://input");
        $formData = json_decode($rawData, true);
        $response = Request::create($formData);
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