<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\ErrorHandler;

final class HomeController extends Controller 
{

    use ErrorHandler;

    public function index(): void
    {
        $this->view('home\\home');
    }
}