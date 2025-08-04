<?php

namespace App;

use PDO;
use PDOException;

class Database {
    // As informações de conexão são as mesmas do docker-compose.yml
    private static $host = 'db'; 
    private static $db_name = 'estoque';
    private static $username = 'user';
    private static $password = 'userpass';
    private static $conn;

    public static function conectar() {
        // Garante que a conexão seja criada apenas uma vez
        if (self::$conn === null) {
            try {
                // Monta a string de conexão (DSN), incluindo o charset para evitar problemas com acentos
                $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$db_name . ';charset=utf8mb4';
                
                self::$conn = new PDO($dsn, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                // Em caso de falha na conexão, encerra a execução e mostra o erro
                die('Erro de conexão com o banco de dados: ' . $e->getMessage());
            }
        }
        
        // Retorna a conexão existente
        return self::$conn;
    }
}