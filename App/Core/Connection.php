<?php

namespace App\Core;
use PDO;
use PDOException;

/**
 * Estabelece a coneção com o banco de dados.
 * 
 * Realiza uma coneção via PDO com banco de dados, para posteriores maniipulações.
 * **/
class Connection {

    private ?PDO $pdo = null;

    /**
     * Cria a conexão com o banco de dados.
     * 
     * @return PDO $pdo
     */
    public function connect(): PDO {
        // Chaves {} para interpolar o array dentro da string
        $dsn = "mysql:host={$_ENV['host']};port={$_ENV['port']};dbname={$_ENV['db']};charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            ];

        try{
            $this->pdo = new PDO(
                $dsn,
                $_ENV['user'],
                $_ENV['password'],
                $options
            );
        }catch(PDOException $e){
            throw $e("Erro na conexão com servidor. {$e->getMessage()}");
        }

        return $this->pdo;
    }

    /**
     * Fecha a conexão com o banco de dados.
     */
    public function disconnect():void{

        $this->pdo = null;
        return;

    }
}