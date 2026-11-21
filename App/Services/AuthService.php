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

        
        $user = $this->model->find_by_field('email',$email);

        if (empty($user)){
            throw new InvalidArgumentException("E-mail não cadastrado!");
        }

        if(!password_verify($password,$user['senha'])){
            throw new InvalidArgumentException('Senha e/ou e-mail invalidos!');

        }

        $this->login((int)$user['id']);
        return true;
    
        
    }

    /**Efetua o login na sesssion */
    private function login(int $user_id): void
    {
        session_regenerate_id(true);
        $_SESSION['user_id_login'] = $user_id;
    }
}
