<?php

namespace App\Models;

use App\Database;
use PDO;
class Produto {
    // Função para listar todos os produtos do banco
    public static function listarTodos() {
        $pdo = Database::conectar();
        $stmt = $pdo->query("SELECT * FROM produtos"); // Supondo que a tabela se chama 'produtos'
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function buscarPorId($id) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function criar($dados) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("INSERT INTO produtos (nome, quantidade, preco) VALUES (?, ?, ?)");
        $stmt->execute([$dados->nome, $dados->quantidade, $dados->preco]);
        return $pdo->lastInsertId();
    }

    public static function atualizar($id, $dados) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, quantidade = ?, preco = ? WHERE id = ?");
        return $stmt->execute([$dados->nome, $dados->quantidade, $dados->preco, $id]);
    }

    public static function deletar($id) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
// class Produto {

    // teste consulta
    // public static function listarTodos() {
    //    $pdo = Database::conectar();
    //    $stmt = $pdo->query("SELECT * FROM produtos");
    //    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //}


    // implementar
    // public static function inserir($dados) {
    //     $pdo = Database::conectar();
    //     $stmt = $pdo->prepare("INSERT INTO produtos (nome, quantidade) VALUES (?, ?)");
    //     return $stmt->execute([
    //         $dados['nome'],
    //         $dados['quantidade']
    //     ]);
    // }
// }
