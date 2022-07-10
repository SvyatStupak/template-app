<?php
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use App\Services\App;

require_once __DIR__ . "/public/debug.php";

require_once __DIR__ . "/vendor/autoload.php";

App::start();

require_once __DIR__ . "/routes/routes.php";


