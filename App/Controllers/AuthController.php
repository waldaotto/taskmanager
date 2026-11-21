<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\ErrorHandler;
use App\Services\AuthService;
use Exception;
use InvalidArgumentException;

final class AuthController extends Controller 
{

    use ErrorHandler;

    protected AuthService $service;

    public function __construct() {
        $this->service = new AuthService();
    }

    public function index(string $message = ''): void
    {
        if (!empty($_SESSION["user_id_login"])){
            $this->redirect('app');
        }

        $data = $this->get_placeholder();
        $data['message'] = $message;
    
        $this->view('auth\\auth',$data);
    }

    /**Retorna os valores do formulario de log-in da pagina inicial */
    private function get_placeholder():array
    {
        $username = $_GET['nome'] ?? null;
        $email = $_GET['email'] ?? null;

        return ['nome_input'=>$username,'email_input'=>$email];
    }

    public function login(): void
    {
        $email = (string) ($_POST['email'] ?? '');
        $senha = (string)( $_POST['senha'] ?? '');

        if (empty($email) || empty($senha) || $email == '' || $senha == '')
        {
            $this->index("Preencha todos os campos!");
            return;
        }

        try
        {
            $auth = $this->service->auth($email,$senha);

            if ($auth){
                $this->redirect('app');
            }
            
        }
        catch(InvalidArgumentException $e)
        {
            $this->index($e->getMessage());
            return;
        }
        catch(Exception $e){
            self::handler(500,$e->getMessage());
            return; 
        }

    }

    public function index_cadastro(array $data = []){
        if (!empty($_SESSION["user_id_login"])){
            $this->redirect('app');

        }

        $this->view('auth\\cadastro',$data);
    }

    public function cadastro(): void 
    {
        $nome = (string) ($_POST['nome'] ?? '');
        $email = (string) ($_POST['email'] ?? '');
        $senha = (string) ($_POST['senha'] ?? '');
        $senha_confirm = (string) ($_POST['senha-confirm'] ?? '');

        $data = [
            'nome_fill'=>$nome,
            'email_fill'=>$email
            ];

        if (
            empty($nome) ||
            empty($email) ||
            empty($senha) ||
            empty($senha_confirm)
        ){
            $data['message'] = 'Preencha todos os campos!';

            $this->index_cadastro($data);
            return;
        }

        if ($senha != $senha_confirm){
            $data['message'] = 'As duas senhas devem ser a mesma!';

            $this->index_cadastro($data);
            return;
        }
        try{
            $user_id = (int) $this->service->cadastrar($email,$nome,$senha);
            $auth = $this->service->auth($email,$senha);

            $this->redirect('app');
            
        }
        catch (InvalidArgumentException $e){
            $data['message'] = $e->getMessage();

            $this->index_cadastro($data);
            return;
        }
        catch(Exception $e){
            self::handler(500,$e->getMessage());
        }
    }
}