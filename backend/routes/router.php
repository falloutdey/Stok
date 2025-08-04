<?php

use App\Controllers\ProdutoController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;

// Este arquivo retorna um array com todas as rotas da aplicação.
return [
    'GET' => [
        '/' => fn($params) => (new HomeController())->index($params),
        '/produtos' => fn($params) => (new ProdutoController())->index($params),
        '/produtos/{id}' => fn($params) => (new ProdutoController())->show($params),
    ],
    'POST' => [
        '/login' => fn($params) => (new AuthController())->login($params),
        '/produtos' => fn($params) => (new ProdutoController())->store($params),
        '/register' => fn($params) => (new AuthController())->register($params), // <-- ADICIONE ESTA LINHA
    ],
    'PUT' => [
        '/produtos/{id}' => fn($params) => (new ProdutoController())->update($params),
    ],
    'DELETE' => [
        '/produtos/{id}' => fn($params) => (new ProdutoController())->destroy($params),
    ],
    
];