<?php
namespace App\Controllers;

use App\Models\Produto; // quando o Model estiver pronto

class ProdutoController {
        public function index($params) {
        header('Content-Type: application/json');

        // Busca os produtos do banco de dados usando o Model
        $produtos = Produto::listarTodos();

        echo json_encode(['data' => $produtos]);

        
    }
         // GET /produtos/{id}
    public function show($params) {
        $id = $params[0];
        $produto = Produto::buscarPorId($id);
        echo json_encode(['success' => true, 'data' => $produto]);
    }

    // POST /produtos
    public function store($params) {
        $dados = json_decode(file_get_contents('php://input'));
        $produtoId = Produto::criar($dados);
        echo json_encode(['success' => true, 'message' => 'Produto criado!', 'id' => $produtoId]);
    }

    // PUT /produtos/{id}
    public function update($params) {
        $id = $params[0];
        $dados = json_decode(file_get_contents('php://input'));
        Produto::atualizar($id, $dados);
        echo json_encode(['success' => true, 'message' => 'Produto atualizado!']);
    }

    // DELETE /produtos/{id}
    public function destroy($params) {
        $id = $params[0];
        Produto::deletar($id);
        echo json_encode(['success' => true, 'message' => 'Produto deletado!']);
    }
    
 
 
    /*

    public function index($params) {
        header('Content-Type: application/json'); // Adicione para garantir JSON
        // echo json_encode(['msg' => 'Produto Controller: Bem-vindo à página de produtos!']);
        // Exemplo de como você pode querer retornar dados de produtos:
        
        $produtos = [
            ['id' => 1, 'nome' => 'Produto A', 'quantidade' => 10],
            ['id' => 2, 'nome' => 'Produto B', 'quantidade' => 5],
            ['id' => 3, 'nome' => 'Produto C', 'quantidade' => 20]
        ];

        echo json_encode(['data' => $produtos]);
    }

    public function store() { // Supondo que store é para POST
        header('Content-Type: application/json');
        // $dadosRecebidos = (object) $_REQUEST; // Se for form-data ou x-www-form-urlencoded
        // Se for JSON no corpo do POST:
        // $dadosRecebidos = json_decode(file_get_contents('php://input'));
        echo json_encode(['msg' => 'Produto Controller: Produto criado/processado (store).']);
    }

    // ... outras funções como listarTodos, criar ...
} 
*/
        }