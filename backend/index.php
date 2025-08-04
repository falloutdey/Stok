<?php
require_once __DIR__ . '/vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit(0);
}

$router = require_once __DIR__ . '/routes/router.php';
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$requestMethod = $_SERVER["REQUEST_METHOD"];

require_once __DIR__ . '/routes/RouterHandler.php';

try {
    RouterHandler::handle($router, $uri, $requestMethod);
} catch (Exception $e) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}