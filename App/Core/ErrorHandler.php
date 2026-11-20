<?php

namespace App\Core;

/**Trata os erros por codigo */
trait ErrorHandler
{

    public static function handler(int $code, string $message): void
    {
        $codes = [200,404,500,400,503,401];

        if (!in_array($code,$codes))
            {
                throw new \Exception("CODIGO DE PAGINA INVALIDA PARA HANDLER DE ERROS");
            }

        http_response_code($code);

        ob_start();
        require_once __DIR__ . "/../Views/errors/{$code}.php";

        $content = ob_get_clean();

        echo $content;
        exit;

    }
}