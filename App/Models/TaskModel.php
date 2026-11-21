<?php

namespace App\Models;
use App\Core\Model;
use PDOException;

final class TaskModel extends Model 
{
    protected string $table = "tasks";

    /**
     * Busca todas tarefas com data para hoje
     */
    public function today_tasks():array
    {

        $sql = "SELECT * FROM {$this->table} WHERE data_task = :today";

        try{
            $stmt = $this->cursor->prepare($sql);
            $stmt->execute([':today'=>date('Y-m-d')]);
        } catch (PDOException $error) {
            throw $error("Erro durante conexão com banco de dados: $error");
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
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        try{
            $stmt = $this->cursor->prepare($sql);
            $stmt->execute();
        } catch (PDOException $error) {
            throw $error("Erro durante conexão com banco de dados: $error");
        }

        return (int) $stmt->fetchColumn();
    }

    public function total_concluida():int 
    {
         $sql = "SELECT COUNT(*) FROM {$this->table} WHERE status = 0";
        try{
            $stmt = $this->cursor->prepare($sql);
            $stmt->execute();
        } catch (PDOException $error) {
            throw $error("Erro durante conexão com banco de dados: $error");
        }

        return (int) $stmt->fetchColumn();
    }

    public function total_pendente():int 
    {
         $sql = "SELECT COUNT(*) FROM {$this->table} WHERE status = 1";
        try{
            $stmt = $this->cursor->prepare($sql);
            $stmt->execute();
        } catch (PDOException $error) {
            throw $error("Erro durante conexão com banco de dados: $error");
        }

        return (int) $stmt->fetchColumn();
    }
}