<?php

// echo json_encode(['msg' => 'Roteador PHP iniciado']);

function load(string $controller, string $action)
{
    try {
        // se controller existe
        $controllerNamespace = "App\\Controllers\\{$controller}";

        if (!class_exists($controllerNamespace)) {
            throw new Exception("O controller {$controller} não existe");
        }

        $controllerInstance = new $controllerNamespace();

        if (!method_exists($controllerInstance, $action)) {
            throw new Exception(
                "O método {$action} não existe no controller {$controller}"
            );
        }

        $controllerInstance->$action((object) $_REQUEST);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

$router = [
  "GET" => [
    "/" => fn () => load("HomeController", "index"),
    "/produtos" => fn () => load("ProdutoController", "index"),
  ],
  "POST" => [
    "/produtos" => fn () => load("ProdutoController", "store"),
  ],
];