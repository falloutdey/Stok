<?php
namespace App\Models;

use App\Database;
use PDO;
use PDOException;

class Usuario {
    
    // Busca um usuário pelo email.
    
    public static function findByEmail($email) {
        $pdo = Database::conectar();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        public static function create($dados) {
        try {
            $pdo = Database::conectar();
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
            
            $stmt->execute([
                ':nome' => $dados->nome,
                ':email' => $dados->email,
                ':senha' => $dados->password
            ]);
            
            return true; // Retorna sucesso
        } catch (PDOException $e) {
            // Em um ambiente real, você logaria o erro em vez de exibi-lo
            // error_log($e->getMessage());
            return false; // Retorna falha
        }
    }
}
