<?php

namespace App\Services;

use App\Models\TaskModel;
use App\Models\TasksModel;
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
}