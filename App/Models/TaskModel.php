<?php

namespace App\Models;
use App\Core\Model;
use Exception;
use PDOException;

final class TaskModel extends Model 
{
    protected string $table = "tasks";

    /**
     * Busca todas tarefas com data para hoje
     */
    public function today_tasks():array
    {
        $id = $_SESSION['user_id_login'];
        $sql = "SELECT * FROM {$this->table} WHERE data_task = :today AND user_id = {$id}";

        try{
            $stmt = $this->cursor->prepare($sql);
            $stmt->execute([':today'=>date('Y-m-d')]);
        } catch (PDOException $error) {
            throw new Exception("Erro durante conexão com banco de dados: $error");
        }

        $result = $stmt->fetchAll();
        if (!$result){
            return [];
        }
        return $result;
       

    }

    /**
     * Retorna total de tarefas cadastradas
     */
    public function total_tasks():int 
    {
        $id = $_SESSION['user_id_login'];
        $sql = "SELECT COUNT(*) FROM {$this->table} where user_id = {$id}";
        try{
            $stmt = $this->cursor->prepare($sql);
            $stmt->execute();
        } catch (PDOException $error) {
            throw new Exception("Erro durante conexão com banco de dados: $error");
        }

        return (int) $stmt->fetchColumn();
    }

    public function total_concluida():int 
    {
        $id = $_SESSION['user_id_login'];
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE status = 0 AND user_id = {$id}";
        try{
            $stmt = $this->cursor->prepare($sql);
            $stmt->execute();
        } catch (PDOException $error) {
            throw new Exception("Erro durante conexão com banco de dados: $error");
        }

        return (int) $stmt->fetchColumn();
    }

    public function total_pendente():int 
    {
        $id = $_SESSION['user_id_login'];
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE status = 1 AND user_id = {$id}";
        try{
            $stmt = $this->cursor->prepare($sql);
            $stmt->execute();
        } catch (PDOException $error) {
            throw new Exception("Erro durante conexão com banco de dados: $error");
        }

        return (int) $stmt->fetchColumn();
    }

    public function find_all():array {
        $id = $_SESSION["user_id_login"];
        $stmt = $this->cursor->query("SELECT * FROM {$this->table} AND user_id = {$id}");
        return $stmt->fetchAll();

    }
}