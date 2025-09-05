<?php

// Esta classe serve para conectar o PHP a um banco de dados MySQL usando PDO

class Database // Define a classe Database
{
    // Endereço do servidor do banco de dados
    private string $host = 'localhost';
    // Nome do banco de dados
    private string $db_name = 'shop_login';
    // Usuário do banco de dados
    private string $username = 'root';
    // Senha do banco de dados
    private string $password = 'root';
    // Conexão PDO (inicia como nula)
    private ?PDO $conn = null;

    // Função para obter a conexão com o banco de dados
    public function getConnection(): PDO
    {
        // Se já existe uma conexão, retorna ela
        if (null !== $this->conn) {
            return $this->conn;
        }

        try {
            // Cria uma nova conexão PDO com os dados informados
            $this->conn = new PDO(
                sprintf("mysql:host=%s;dbname=%s", $this->host, $this->db_name),
                $this->username,
                $this->password,
            );

            // Configura o PDO para mostrar erros como exceções
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Define o charset para UTF-8
            $this->conn->exec("SET NAMES 'utf8'");
        } catch (PDOException $exception) {
            // Se ocorrer erro, mostra a mensagem
            echo "Erro de conexão: " . $exception->getMessage();
        } catch (\Throwable $throwable) {
            // Se ocorrer erro, mostra a mensagem
            echo "Erro inesperado: " . $throwable->getMessage();
        }

        // Retorna a conexão criada
        return $this->conn;
    }
}
