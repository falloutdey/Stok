<?php
namespace App\Controllers; // Corrigido para App

class HomeController
{
  public function index($params)
  {
    header('Content-Type: application/json'); // Adicione para garantir JSON
    echo json_encode(['msg' => 'Home Controller: Bem-vindo à página inicial!']);
    // echo json_encode(['data' => ['produto1', 'produto2', 'produto3']]);
  }
}