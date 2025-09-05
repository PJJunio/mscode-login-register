-- Cria o banco de dados
CREATE DATABASE shop_login;

-- Seleciona o banco de dados
USE shop_login;

-- Cria a tabela user
CREATE TABLE IF NOT EXISTS user (
	id INT AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	cidade VARCHAR(255) NOT NULL,
	password VARCHAR(100) NOT NULL,
	status BOOLEAN DEFAULT true NOT NULL,
	PRIMARY KEY(id)
);
-- Adicionar exemplos
INSERT INTO user (nome, email, cidade, password) VALUES 
('João Silva', 'joao.silva@email.com', 'São Paulo', 'senha123'),
('Maria Oliveira', 'maria.oliveira@email.com', 'Rio de Janeiro', 'senha456'),
('Pedro Souza', 'pedro.souza@email.com', 'Belo Horizonte', 'senha789'),
('Ana Costa', 'ana.costa@email.com', 'Curitiba', 'senhaabc'),
('Carlos Pereira', 'carlos.pereira@email.com', 'Porto Alegre', 'senhaxyz');

-- Exibe dados da tabela user
SELECT * FROM user;
