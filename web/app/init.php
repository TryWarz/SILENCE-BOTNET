<?php
require_once dirname(__DIR__) . '/config/application.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/config/api.php';

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

require_once dirname(__DIR__) . '/app/functions.php';
require_once dirname(__DIR__) . '/app/Models/Database.php';
require_once dirname(__DIR__) . '/app/Models/RateLimit.php';
require_once dirname(__DIR__) . '/app/Models/Blacklist.php';
require_once dirname(__DIR__) . '/app/Models/User.php';
require_once dirname(__DIR__) . '/app/Models/Attack.php';
require_once dirname(__DIR__) . '/app/Models/Plan.php';
require_once dirname(__DIR__) . '/app/Models/Log.php';
require_once dirname(__DIR__) . '/app/Services/RequestApi.php';
require_once dirname(__DIR__) . '/app/Services/DiscordWebhook.php';

// Create a database connection
$GLOBALS['DB'] = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

$currentPage = substr($_SERVER["SCRIPT_NAME"], 1, -4);
$controllerPath = dirname(__DIR__) . "/app/Controllers/";

if (file_exists($controllerPath . $currentPage . '.controller.php')) {
    require_once $controllerPath . $currentPage . '.controller.php';
}
