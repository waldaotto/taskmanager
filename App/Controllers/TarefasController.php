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

        $this->view('layouts\\header',['title'=>'Tarefas']);
        $this->view('tarefas\\tarefas',['tasks'=>$this->formatar_data($this->buscar_tarefa())]);
    }

    public function criar_tarefa(): void
    {

        if(strtolower(Helper::request()) != 'post'){
            self::handler(404,"Método não aceito");
        }

        $tarefa_titulo = !empty($_POST['titulo']) ? trim((string) $_POST['titulo']) : '';
        $tarefa_descricao = !empty($_POST['descricao']) ? trim((string) $_POST['descricao']) : '';
        $tarefa_data = !empty($_POST['data_task']) ? (string) $_POST['data_task'] : '';

        $data_task = date('Y/m/d', strtotime($tarefa_data));

        if(
            empty($tarefa_data) ||
            empty($tarefa_titulo))
        {
            $this->redirect('banana');
        }

        try {
            $this->service->create_task($tarefa_titulo,$tarefa_descricao,$data_task);
            $this->redirect('tarefas');
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

        $id = !empty($_POST["id"]) ? (int) $_POST["id"] : null;

        if (empty($id)){
            $this->redirect('tarefas');
        }

        $delete = $this->service->delete_task($id);

        if(!$delete){
            self::handler(500,"Erro ao deletar");
        }

        $this->redirect('tarefas');
    }

    public function atualizar_tarefa():void
    {
        if(strtolower(Helper::request()) != 'post'){
            return;
        }
    
        $id = !empty($_POST["id"]) ? (int) $_POST["id"] : null;
        $titulo = !empty($_POST["titulo"]) ? trim($_POST["titulo"]) : null;
        $descricao = !empty($_POST["descricao"]) ? trim($_POST["descricao"]) : null;
        $data_task = !empty($_POST["data_task"]) ? $_POST["data_task"] : null;
        $status = isset($_POST["status"]) ? (int) $_POST["status"] : null;

        $data_task = date('Y/m/d', strtotime($data_task));

        try{
        
            $this->service->update_task($id,['titulo'=>$titulo,'descricao'=>$descricao,'data_task'=>$data_task,'status'=>$status]);
            $this->redirect('tarefas');
            
        } catch(Exception $e) {
            self::handler(500,$e->getMessage());
        }
    }   

    public function buscar_tarefa():array
    {
        if(empty($_GET["filter"]) || empty( $_GET["filter_value"])){
            return $this->service->find_all();
        }

        $filter = (int) trim($_GET["filter"]) ?? [];
        $filter_value = (int) trim($_GET["filter_value"]) ?? [];

        if(empty($filter_value) || empty($filter)){
            return $this->service->find_all();
        }

        if ($filter == 'data'){
            try{
                $this->index($this->service->find_data($filter_value));
            } catch (Exception $e){
                self::handler(500,$e->getMessage());
            }
        }

        elseif ($filter == 'titulo'){
            try{
                return ($this->service->find_titulo($filter_value));
            } catch (Exception $e){
                self::handler(500,$e->getMessage());
            }
        }

        else {
            self::handler(500,"Valor inserido de filtro invalido");
            
        }
        return [];
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