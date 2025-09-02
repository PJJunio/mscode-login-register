-- Cria o banco de dados
CREATE DATABASE shop_login;

-- Seleciona o banco de dados
USE shop_login;

-- Cria a tabela user
CREATE TABLE IF NOT EXISTS user (
	id INT AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(100) NOT NULL,
	PRIMARY KEY(id)
);

-- Exibe dados da tabela user
SELECT * FROM user;
