<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\ErrorHandler;
use App\Core\Helper;
use App\Services\TaskService;
use Exception;

final class TarefasController extends Controller 
{

    use ErrorHandler;

    protected TaskService $service;

    public function __construct()
    {
        $this->service = new TaskService;
    }

    public function index(array $data = []): void
    {

        $this->view('layouts\\header');
        $this->view('tarefas\\tarefas',['tasks'=>$data]);
    }

    public function criar_tarefa(): void
    {

        if(strtolower(Helper::request()) != 'post'){
            self::handler(404,"Método não aceito");
        }

        $tarefa_titulo = (string)($_POST['tarefa_titulo']) ?? '';
        $tarefa_descricao = (string)($_POST['tarefa_descricao']) ?? '';
        $tarefa_data = (string)($_POST['tarefa_data']) ?? '';

        if(
            empty($tarefa_data) ||
            empty($tarefa_descricao) ||
            empty($tarefa_titulo))
        {
            $this->redirect('/tarefas');
        }

        try {

        }catch(Exception $e){
            self::handler(500,$e->getMessage());
        }
    }

    /**
     * Deleta uma tarefa
     */
    public function deletar_tarefa(): void
    {
        if(strtolower(Helper::request()) != 'post'){
            self::handler(404,"Método não aceito");
        }

        $task_id = (int) $_POST["task_id"];

        if (empty($task_id)){
            $this->redirect('/tarefas');
        }

        $delete = $this->service->delete_task($task_id);

        if(!$delete){
            self::handler(500,"Erro ao deletar");
        }

        $this->redirect('/tarefas');
    }

    public function atualizar_tarefa():void
    {
        if(strtolower(Helper::request()) != 'get'){
            self::handler(404,"Método não aceito");
        }

        $task_id = (int) $_GET["task_id"];

        // TEM QUE FAZER O DE BUCAS PRA ESSE
    }

    public function buscar_tarefa():void
    {
        if(strtolower(Helper::request()) != 'get'){
            self::handler(404,"Método não aceito");
        }

        $filter = (int) $_GET["filter"];
        $filter_value = (int) $_GET["filter_value"];

        if(empty($filter_value) || empty($filter)){
            $this->index($this->service->find_all());
        }
    }
}