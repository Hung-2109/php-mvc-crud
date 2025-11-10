<?php
// Front controller
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Database.php';

// Simple router: ?route=controller/action&id=...
$route = $_GET['route'] ?? 'products/index';
[$controllerName, $action] = array_pad(explode('/', $route), 2, null);
$controllerName = $controllerName ?: 'products';
$action = $action ?: 'index';

$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerClass . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo 'Controller not found';
    exit;
}
require_once $controllerFile;
$controller = new $controllerClass();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo 'Action not found';
    exit;
}

// Dispatch
$controller->$action();
