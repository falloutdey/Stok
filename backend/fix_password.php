<?php
// Script para corrigir a senha do usuário admin diretamente no banco.

echo "<pre>"; // Para formatar a saída no navegador
echo "Iniciando script de correção de senha...\n\n";

// 1. Configurações do Banco de Dados
$host = 'db';
$dbname = 'estoque';
$user = 'user';
$pass = 'userpass';
$adminEmail = 'admin@stok.com';
$correctPassword = '123456';

// 2. Gerar o hash correto e definitivo
$correctHash = password_hash($correctPassword, PASSWORD_DEFAULT);
echo "--> Senha que será usada: " . $correctPassword . "\n";
echo "--> Hash que será gravado no banco: " . $correctHash . "\n\n";

// 3. Conectar ao Banco de Dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "--> Conexão com o banco de dados 'estoque' realizada com SUCESSO.\n";
} catch (PDOException $e) {
    die("ERRO FATAL: Não foi possível conectar ao banco de dados. " . $e->getMessage());
}

// 4. Atualizar a senha do usuário 'admin@stok.com' no banco
try {
    $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
    $stmt->execute([
        ':senha' => $correctHash,
        ':email' => $adminEmail
    ]);

    if ($stmt->rowCount() > 0) {
        echo "--> SUCESSO! A senha do usuário '" . $adminEmail . "' foi corrigida no banco de dados.\n";
    } else {
        echo "--> AVISO: O usuário '" . $adminEmail . "' não foi encontrado. O banco pode estar sem dados.\n";
    }
} catch (PDOException $e) {
    die("ERRO FATAL: Falha ao executar o comando UPDATE na tabela 'usuarios'. " . $e->getMessage());
}

echo "\nScript finalizado. A senha agora está 100% correta. Por favor, tente o login novamente.";
echo "</pre>";