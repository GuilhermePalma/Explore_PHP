<?php

    if(!defined('ROOT_PROJECT')) {
        if(DEBUG) echo "Caminho ROOT não encontrado";
        exit;
    } else if(DEBUG === false){
        // Esconde todos os erros
        error_reporting(0);
        ini_set("display_errors", 0);
    } else {
        // Mostra todos os erros
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

    }

    // Função de Escopo Global (public) do Projeto
    /**
     * Verifica chaves de arrays
     *
     * Verifica se a chave existe no array e se ela tem algum valor.
     *
     */
    function chk_array($array, $key) {
        // Verifica se a Chave possui Valor
        if (isset($array[ $key ]) && ! empty($array[ $key ])) {
            // Retorna o Valor da Chave
            return $array[ $key ];
        }

        // Retorna nulo por padrão
        return null;
    }

    include_once CONTROLLER_PATH . "\\HandlerController.php";
    $handler_controller= new HandlerController();
?>