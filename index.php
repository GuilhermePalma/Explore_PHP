<?php
require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;

// Variavel de Ambiente da URL
define('URL', 'http://localhost/php/explore_php');

// Incia o Valor Padrão das Variaveis
View::init(
    ['URL' => URL]
);

// Inicia o Controlador de Rotas
$router = new Router(URL);

// Adiciona o Arquivos de Rotas
include __DIR__ . '/Routes/Pages.php';

// Mostra a Resposta/Pagina na Tela
$router->run()->sendResponse();
