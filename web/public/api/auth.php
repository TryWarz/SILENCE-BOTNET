<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-type: application/json');

require_once dirname(dirname(__DIR__)) . '/app/init.php';

$error_response = [
    "error" => false,
    "reason" => ""
];

if (!isset($_POST['username']) || empty($_POST['username'])) {
    $error_response["error"] =  true;
    $error_response['reason'] = "the 'username' field is empty";
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
    $error_response["error"] =  true;
    $error_response['reason'] = "the 'password' field is empty";
}

if ($error_response['error'] !== true) {
    $auth = User::checkAuthenticate($_POST['username'], $_POST['password']);
} else {
    $auth = false;
}

if (!$auth) {
    $error_response["error"] =  true;
    $error_response['reason'] = "Username or password invalid";
} else {
    $_SESSION['user']['id'] = $auth['id'];
    $error_response['reason'] = "Login successfully";
}

/**
 * Encode the error response array as a JSON response.
 */
echo json_encode($error_response);