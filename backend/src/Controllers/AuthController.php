<?php
namespace App\Controllers;

use App\Models\Usuario;

class AuthController {
    public function login($params) {
        // Pega os dados JSON enviados pelo frontend
        $dados = json_decode(file_get_contents('php://input'));

        // Valida se os dados foram recebidos e decodificados corretamente
        if (!$dados || !isset($dados->email) || !isset($dados->password)) {
            http_response_code(400); // Bad Request
            echo json_encode(['success' => false, 'message' => 'Dados de entrada inválidos ou ausentes.']);
            return;
        }

        // Busca o usuário no banco de dados
        $usuario = Usuario::findByEmail($dados->email);

        // Verifica se o usuário existe e se a senha está correta
        if ($usuario && password_verify($dados->password, $usuario['senha'])) {
            // Login bem-sucedido
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Login realizado com sucesso!',
                'usuario' => [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'email' => $usuario['email']
                ]
            ]);
        } else {
            // Credenciais inválidas
            http_response_code(401); // Unauthorized
            echo json_encode(['success' => false, 'message' => 'Email ou senha inválidos.']);
        }
    }
        public function register($params) {
        // Pega os dados JSON enviados pelo frontend
        $dados = json_decode(file_get_contents('php://input'));

        // Valida se os dados necessários foram enviados
        if (!$dados || !isset($dados->nome) || !isset($dados->email) || !isset($dados->password)) {
            http_response_code(400); // Bad Request
            echo json_encode(['success' => false, 'message' => 'Nome, email e senha são obrigatórios.']);
            return;
        }

        // Verifica se o email já existe no banco
        if (Usuario::findByEmail($dados->email)) {
            http_response_code(409); // Conflict
            echo json_encode(['success' => false, 'message' => 'Este email já está em uso.']);
            return;
        }

        // Criptografa a senha antes de salvar
        $dados->password = password_hash($dados->password, PASSWORD_DEFAULT);

        // Tenta criar o usuário no banco de dados
        $success = Usuario::create($dados);

        if ($success) {
            http_response_code(201); // Created
            echo json_encode(['success' => true, 'message' => 'Usuário cadastrado com sucesso!']);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['success' => false, 'message' => 'Ocorreu um erro ao cadastrar o usuário.']);
        }
    }
}