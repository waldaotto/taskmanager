<?php

namespace App\Services;
use App\Models\UsersModel;
use Exception;
use InvalidArgumentException;

final class AuthService 
{
    protected UsersModel $model;

    public function __construct()
    {
        $this->model = new UsersModel();

    }

    public function auth(string $email,string $password): bool
    {
    
        if($email == '' || $password == ''){
            throw new InvalidArgumentException("E-mail e senha não pode estar vazios!");
        }

        if (!$this->email_valido($email)){
            throw new InvalidArgumentException(("E-mail invalido!"));
        }

        
        $user = $this->model->find_by_field('email',$email);


        if (empty($user)){
            throw new InvalidArgumentException("E-mail não cadastrado!");
        }

        if(!password_verify($password,$user['senha'])){
            throw new InvalidArgumentException('Senha e/ou e-mail invalidos!');

        }

        $this->login((int)$user['id'],(string)$user["nome"]);
        return true;
    
        
    }

    private function email_valido(string $email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }

        if (!checkdnsrr(substr(strrchr($email, '@'), 1), 'MX')){
            return false;
        }

        return true;
    }

    /**Efetua o login na sesssion */
    private function login(int $user_id,string $user_name): void
    {
        session_regenerate_id(true);
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_id_login'] = $user_id;
    }

    public function logout(): void 
    {
        session_destroy();
    }

    /**
     * @return int ID do insert
     */
    public function cadastrar(string $email,string $nome,string $senha): int 
    {

        if (!empty($this->model->find_by_field('email',$email))){
            throw new InvalidArgumentException('E-mail já está cadastrado a uma conta!');
        }

        return $this->model->create(['nome'=>$nome,'email'=>$email,'senha'=>password_hash($senha, PASSWORD_ARGON2ID)]);
    }
}
