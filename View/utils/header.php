<?php

    // Verificação das Importações
    if(!defined('ROOT_PROJECT')) {
        if('DEBUG') echo "Caminho ROOT não encontrado";
        exit;
    } else if(!file_exists(CSS_PATH)) {
        if('DEBUG') echo "Caminho Css não encontrado";
        exit;
    } else if(!file_exists(SCRIPT_PATH)) {
        if('DEBUG') echo "Caminho Scripts não encontrado";
        exit;
    }

    /* Classe que Controla a Importação de Scripts */
    include_once SCRIPT_PATH."\imports.php";
    $import = new Imports();

    /* Definição dos Arquivos no Menu Options
       todo: implementar p/ acionar os Controllers */
    $home = ROOT_PROJECT."\\index.php";
    $user_insert = VIEWS_PATH."\\User\\insertUser.php";
    $user_select = VIEWS_PATH."\\User\\SelectUser.php";
    $user_update = VIEWS_PATH."\\User\\updateUser.php";
    $user_delete= VIEWS_PATH."\\User\\deleteUser.php";
    $user_list = VIEWS_PATH."\\User\\selectAllUser.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->title ?></title>

    <!-- Importação dos Scripts via PHP -->

    <!-- Importação Semantic UI para os Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">
    </script>

    <style type="text/css">
        <?php echo $import->import("semantic_ui_css"); ?>
    </style>

    <script type="text/javascript">
        <?php echo $import->import("semantic_ui_js"); ?>
    </script>

    <script type="text/javascript">
        <?php echo $import->import("dropdown_js"); ?>
    </script>

</head>
<body>
    <div class="ui container">
        <div class="ui menu">
            <div class="ui container">
                <a href="index.php" class="header item">
                    Explore PHP
                </a>
                <a href="index.php" class="active item">Inicio</a>

                <div class="ui pointing dropdown item" tabindex="0">
                    Usuario
                    <i class="dropdown icon"></i>
                    <div class="menu transition hidden" tabindex="-1">
                        <a href="View/User/insertUser.php"
                            class="item">Cadastro</a>
                        <a href="View/User/selectUser.php"
                            class="item">Detalhes</a>
                        <a href="View/User/updateUser.php"
                            class="item">Atualizar</a>
                        <a href="View/User/deleteUser.php"
                            class="item">Excluir</a>
                        <div class="divider"></div>
                        <a href="View/User/selectAllUser.php"
                            class="item">Listar Usuario</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Conteudo é Carregado nessa Parte -->