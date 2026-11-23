<?php

namespace App\Core;
use App\Core\Helper;
use App\Core\ErrorHandler;

final class Router
{
    use ErrorHandler;

    public static function routes(): array {
        return [
            'get' => [
                '/' => fn() =>  self::load('HomeController',"Index"),
                '/auth' => fn() =>  self::load('AuthController',"index"),
                '/auth/cadastro' => fn() =>  self::load('AuthController',"index_cadastro"),
                '/app' => fn() =>  self::load('DashboardController',"index"),
                '/tarefas' => fn() =>  self::load('TarefasController',"index"),
                '/agenda' => fn() =>  self::load('AgendaController',"index"),
                
            ],

            'post' => [
                '/auth' => fn() =>  self::load('AuthController',"login"),
                '/auth/cadastro' => fn() =>  self::load('AuthController',"cadastro"),
                '/tarefas/cadastrar' => fn() =>  self::load('TarefasController',"criar_tarefa"),
                '/tarefas/editar' => fn() =>  self::load('TarefasController',"atualizar_tarefa"),
                '/tarefas/excluir' => fn() =>  self::load('TarefasController',"deletar_tarefa"),
            ]
        ];
    }

    /**
     * Load controller->method 
     * @param string $controller Controller name
     * @param string $method Controller method name
     * @return object
     */
    public static function load(string $controller, string $method) 
    {

        try
        {
            $controller_namespace = CONTROLLER_NAMESPACE."\\".$controller;

            if (!class_exists($controller_namespace)){
                echo $controller_namespace;
                self::handler(500,"Controller {$controller} nâo existe");
            }

            $instance = new $controller_namespace;

            if(!method_exists($instance,$method)){
                self::handler(500,"Metodo {$method} não existe em {$controller_namespace}");
                
            }
        
            return $instance->$method();
        }
        catch (\Throwable $th)
        {
            throw $th;
        }

    }

    public static function execute()
    {
        try
        {
            $routes = self::routes();
            $request = Helper::request();
            $uri = Helper::uri('path');

            if (!isset($routes[$request])){
                throw new \Exception("Request Metodo não existe.");
            }

            if (!array_key_exists($uri, $routes[$request])){
                self::handler(404,"A rota {$uri} não existe.");
            }

            $router = $routes[$request][$uri];

            if (!is_callable($router)){
                self::handler(404,"Route not callable");
            }


            // VERIFICAÇÃO DE LOGIN
            // Nao logado redireciona qualquer tela para a home
            if (empty($_SESSION["user_id_login"]) && $uri != '/auth' && $uri != '/auth/cadastro')
            {   
                return $routes['get']['/']();
            }

            return $router();

        }
        catch (\Throwable $th)
        {   
            self::handler(500,$th->getMessage());
        }
    }
}
