<?php
define('ROOT', dirname(__DIR__));
require_once ROOT.'/vendor/autoload.php';
require_once __DIR__."/../App/Core/defines.php";

$dotenv = Dotenv\Dotenv::createImmutable(
    dirname(__DIR__)
);

$dotenv->load();

use App\Core\Router;
$router = new Router();

echo $_ENV["APP_NAME"];


