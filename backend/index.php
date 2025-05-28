<?php
// echo json_encode(["status" => "API rodando"]);

require_once __DIR__ . '/vendor/autoload.php';

use App\Database;

// Permitir CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Carregar rotas
require_once __DIR__ . '/routes/router.php';


try {

  // echo "<pre>"; print_r($_SERVER); echo "</pre>";exit;
  // echo "<pre>"; print_r($_SERVER); echo "</pre>";exit;
  // echo "<pre>"; print_r($_SERVER); echo "</pre>";exit;
  
  $uri = parse_url($_SERVER["REQUEST_URI"])["path"];
  
  
  if(($_SERVER["QUERY_STRING"]) != '') {
    $query = parse_url($_SERVER["QUERY_STRING"]);
  }
  $request = $_SERVER["REQUEST_METHOD"];

  // echo "<pre>"; print_r(parse_url($_SERVER["REQUEST_URI"])); echo "</pre>";exit;
  // echo "<pre>"; print_r($_SERVER["QUERY_STRING"]); echo "</pre>";exit;

  if (!isset($router[$request])) {
    throw new Exception("A rota não existe");
  }

  if (!array_key_exists($uri, $router[$request])) {
    throw new Exception("A rota não existe");
  }

  //  echo "<pre>"; print_r($router); echo "</pre>";
  //  echo "<pre>"; print_r($request); echo "</pre>";
  //  echo "<pre>"; print_r($uri); echo "</pre>";
  // exit;

  $controller = $router[$request][$uri];
  $controller();
} catch (Exception $e) {
  $e->getMessage();
}

