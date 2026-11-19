<?php

namespace App\Core;
use App\Core\Helper;

final class Router
{

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
                throw new InvalidArgumentException("Controller {$controller} nâo existe");
            }

            $instance = new $controller_namespace;

            if(!method_exists($instance,$method)){
                throw new InvalidArgumentException("Metodo {$method} não existe em {$controller_namespace}");
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
                die("A rota {$uri} não existe.");
            }

            $router = $routes[$request][$uri];

            if (!is_callable($router)){
                die("Route not callable");
            }

            return $router();

        }
        catch (\Trhowable $th)
        {
            throw $th;
        }
    }
}
