<?php

namespace App\Models;

use App\Database;
use PDO;

class Produto {

    // teste consulta
    public static function listarTodos() {
        $pdo = Database::conectar();
        $stmt = $pdo->query("SELECT * FROM produtos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // implementar
    // public static function inserir($dados) {
    //     $pdo = Database::conectar();
    //     $stmt = $pdo->prepare("INSERT INTO produtos (nome, quantidade) VALUES (?, ?)");
    //     return $stmt->execute([
    //         $dados['nome'],
    //         $dados['quantidade']
    //     ]);
    // }
}
