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
            $this->redirect('/');
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
        $email = (string) $_POST['email'] ?? '';
        $senha = (string) $_POST['senha'] ?? '';

        if (empty($email) || empty($senha) || $email == '' || $senha == '')
        {
            $this->index("Preencha todos os campos!");
            return;
        }

        try
        {
            $auth = $this->service->auth($email,$senha);

            if ($auth){
                $this->redirect('/');
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
}