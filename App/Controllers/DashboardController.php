<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\ErrorHandler;
use App\Services\TaskService;
use Exception;

final class DashboardController extends Controller 
{

    use ErrorHandler;
    protected TaskService $service;

    public function __construct()
    {
        $this->service = new TaskService;
    }

    public function index(): void
    {

        $data = $this->data_render();   

        $this->view('layouts\\header');
        $this->view('home\\dashboard',$data);
        $this->view('layouts/footer');
    }

    private function data_render(): array
    {
        try{
            $kpis = $this->service->get_kpis();
            $today = $this->formatar_data($this->service->get_today_tasks());

        }catch(Exception $e){
            self::handler(500,$e->getMessage());
            
        }

        return ['task_kpi'=>$kpis ?? [],'today_tasks'=>$today ?? []];
    }

    private function formatar_data(array $today_tasks):array
    {
        if (empty($today_tasks)){
            return [];
        }
        
        $array_formatado = array_map(
            fn($task) => [
                ...$task,
                'data_task' => date('d/m/Y', strtotime($task['data_task']))
            ],
            $today_tasks
        );

        return $array_formatado;
    }
}