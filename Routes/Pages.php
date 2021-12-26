<?php

use \App\Controller\Pages;
use \App\Http\Response;

// Rota da Pagina Inicial
$router->httpGET('/', [
    function () {
        return new Response(200, Pages\HomeController::index());
    },
]);

// Rota da Pagina 'Sobre'
$router->httpGET('/sobre', [
    function () {
        return new Response(200, Pages\AboutController::getAbout());
    },
]);

// Rota Dinamica/Variavels
$router->httpGET('/pagina/{id_page}/{action}', [
    function ($id_page, $action){
        return new Response(200, 'Pagina '.$id_page.'-'.$action);
    },
]);