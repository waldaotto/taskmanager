<?php

namespace App\Services;

use App\Models\TaskModel;
use App\Models\TasksModel;
use App\Models\UserTasksModel;
use Exception;
use InvalidArgumentException;

final class TaskService 
{
    protected TaskModel $model;

    public function __construct()
    {
        $this->model = new TaskModel();

    }

    /**
     * Retorna os kpis totais
     */
    public function get_kpis():array
    {
        $total = $this->model->total_tasks() ?? 0;
        $concluidas = $this->model->total_concluida() ?? 0;
        $pendente = $this->model->total_pendente() ?? 0;

        return [
            'total' => $total,
            'total_concluida' => $concluidas,
            'total_pendente' => $pendente
        ];

    }

    /**
     * Retorna todas as tasks para hoje
     */
    public function get_today_tasks():array
    {
        return $this->model->today_tasks() ?? [];
    }

    /**
     * @return int Valor do id do insert
     */
    public function create_task(string $titulo, string $descricao, string $data):int
    {

        return $this->model->create(['titulo'=>$titulo,'descricao'=>$descricao,'data_task'=>$data,'status'=>1,'user_id'=>$_SESSION['user_id_login']]);
    }

    public function delete_task(int $id):bool
    {
        return $this->model->delete($id);
    }

    public function find_all():array
    {
        return $this->model->find_all();
    }
}