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
            ],

            'post' => []
        ];
    }

    /**
     * Load controller->method 
     * @param string $controller Controller name
     * @param string $method Controller method name
     * @return object
     */
    public static function load(string $controller, string $method): object 
    {

        try
        {
            $controller_namespace = CONTROLLER_NAMESPACE."\\".$controller;

            if (!class_exists($controller_namespace)){
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

            return $router();

        }
        catch (\Trhowable $th)
        {
            self::handler(500,$th->getMessage());
        }
    }
}
