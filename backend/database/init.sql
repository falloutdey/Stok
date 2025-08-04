-- Garante que estamos usando o banco de dados 'estoque', que foi criado pelo docker-compose.
-- Se ele não existir por algum motivo, este comando o cria.
CREATE DATABASE IF NOT EXISTS estoque;
USE estoque;

-- Tabela de Usuários
-- Armazena as informações para login e autenticação.
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Produtos
-- Armazena os itens do estoque.
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0,
    preco DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- DADOS DE EXEMPLO (OPCIONAL, MAS RECOMENDADO PARA TESTES)

-- Inserir um usuário de exemplo.
-- A senha '123456' foi criptografada com password_hash() do PHP.
-- O hash abaixo corresponde a '123456'.
INSERT INTO usuarios (nome, email, senha)
VALUES ('Usuário Admin', 'admin@stok.com', '$2y$10$7J7g.B.LwG9vK0O1ZJgSgOwYk.8Yk3E1zC6w8nO/p.J.5qG9zK/aO');

-- Inserir alguns produtos de exemplo.
INSERT INTO produtos (nome, quantidade, preco)
VALUES
('Mouse Gamer', 50, 125.50),
('Teclado Mecânico', 30, 299.99),
('Monitor 24 polegadas', 25, 899.00),
('Headset RGB', 40, 199.75);