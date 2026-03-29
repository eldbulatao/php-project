<?php

require_once __DIR__ . '/../app/Core/Autoloader.php';

use App\Core\SessionManager;

SessionManager::start();

$controllerName = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$controllerClass =
    "App\\Controllers\\" . ucfirst($controllerName) . "Controller";

if (!class_exists($controllerClass)) {
    die("Controller not found.");
}

$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    die("Action not found.");
}

$controller->$action();