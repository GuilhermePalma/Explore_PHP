<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore PHP</title>

    <link rel="stylesheet" type="text/css"
        href="Content/Css/Semantic_UI/semantic.min.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

    <script src="Content/Css/Semantic_UI/semantic.min.js"></script>
    <script src="Content/Scripts/HandlerDropdown.js"></script>

    <style type="text/css">
        .height_window {
            height:100%;
        }
    </style>

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

    <div class="ui middle aligned stackable grid container height_window">
        <div class="row">
            <div class="center aligned column">
                <h1 class="ui header">Explore PHP</h1>
                <h2>Navegue e utilize um site feito em PHP.</h2>

                <a href="View/User/selectUser.php"
                    class="ui animated huge primary button"
                    tabindex="0">
                    <div class="visible content">Vamos Lá !</div>
                    <div class="hidden content">
                        <i class="right arrow icon"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- todo: Adicionar Conteudo na Tela inical -->

</body>
</html>