<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuario</title>

    <!-- Importação dos Scripts de CSS e JavaScript -->
    <link rel="stylesheet" type="text/css"
        href="../../Content/Css/Semantic_UI/semantic.min.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

    <script src="../../Content/Css/Semantic_UI/semantic.min.js"></script>

    <!-- Estilo do Formulario Centralizado na Tela -->
    <style type="text/css">
        body {
        background-color: #EAEAEA;
        }
        body > .grid {
        height: 100%;
        }
        .image {
        margin-top: -100px;
        }
        .column {
        max-width: 450px;
        }
  </style>
</head>

<body>
<div class="ui middle aligned center aligned grid">
    <div class="column">

        <!-- Dados acima do Formulario -->
        <h2 class="ui teal image header">Atualizar Usuario</h2>

        <!-- Criação do Formulario -->
        <form class="ui large form" method="POST">
            <div class="ui stacked segment">

                <!-- Campos do Formulario -->
                <h3>Insira seus Novos Dados para a Atualização</h3>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="address card icon"></i>
                        <input type="text" name="id_user" placeholder="Codigo do Usuario"
                        value="<?php echo isset($_POST['id_user']) ? $_POST['id_user'] : "";?>">
                    </div>
                    <div class="meta">
                        <span class="date">Caso não Saiba seu Codigo,
                        <a href="codeUser.php">Clique Aqui</a> para consultar</span>
                    </div>
                    <!-- Validação do ID_User -->
                    <?php
                        if(isset($_POST['id_user'])){
                            include_once "../../Model/User.php";
                            // Instancia e Valida o Nome do Usuario
                            $user = new User("","");
                            $user->id_user = $_POST['id_user'];
                            if(!$user->ValidationID()){
                                echo "<div class='ui pointing red basic label'>".
                                    $user->error_validation."</div>";
                                unset($_POST['id_user']);
                            }
                        }
                    ?>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="envelope icon"></i>
                        <input type="text" name="email" placeholder="Email"
                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : "";?>">
                    </div>
                    <!-- Validação do Email -->
                    <?php
                        if(isset($_POST['email'])){
                            include_once "../../Model/User.php";
                            // Instancia e Valida o Nome do Usuario
                            $user = new User("",htmlspecialchars($_POST['email']));
                            if(!$user->ValidationEmail()){
                                echo "<div class='ui pointing red basic label'>".
                                    $user->error_validation."</div>";
                                unset($_POST['email']);
                            }
                        }
                    ?>
                </div>

                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="name" placeholder="Nome Completo"
                        value="<?php echo isset($_POST['name']) ? $_POST['name'] : "";?>">
                    </div>
                    <!-- Validação do Nome -->
                    <?php
                        if(isset($_POST['name'])){
                            include_once "../../Model/User.php";

                            // Instancia e Valida o Nome do Usuario
                            $user = new User(htmlspecialchars($_POST['name']),"");

                            if(!$user->ValidationName()){
                                echo "<div class='ui pointing red basic label'>".
                                    $user->error_validation."</div>";
                                unset($_POST['name']);
                            }
                        }
                    ?>
                </div>

                <input class="ui fluid large teal submit button" type="Submit"
                    name="search" value="Pesquisar">
            </div>
        </form>

        <?php
            // Verifica se a Variavel foi Passada via POST
            if(isset($_POST['email']) && isset($_POST['name']) &&
                isset($_POST['id_user'])) {
                include_once "../../Database/DAO/UserDAO.php";

                $userDAO = new UserDAO();
                $user = new User($_POST['name'], $_POST['email']);
                $user->id_user = $_POST['id_user'];
                $result_details = $userDAO->UpdateUser($user->id_user,
                    $user->name, $user->email);

                if($result_details == ""){

                    $result_details = $userDAO->GetUser($user->name, $user->email);

                    if(is_array($result_details)){
                        echo "<div class='ui positive message'>";
                        echo "Detalhes do Usuario <b>'".$result_details[0]['name'].
                            "'</b>"."<br/>";
                        echo "ID do Usuario: ".$result_details[0]['id_user']."<br/>";
                        echo "Email: ".$result_details[0]['email']."<br/>";
                        echo "Nome: ".$result_details[0]['name']."<br/>"."</div>";
                    } else {
                        echo "<div class='ui error message'>";
                        echo "Não foi Localizar o Usuario <b>'"
                            .$_POST['name']."'</b> no Banco de Dados";
                        echo "<br />".$result_details."<br/>"."Tente Novamente !"."</div>";
                    }
                } else {
                    echo "<div class='ui error message'>";
                    echo "Não foi Atulizar o Usuario <b>'"
                        .$_POST['name']."'</b> no Banco de Dados";
                    echo "<br />".$result_details."<br/>"."Tente Novamente !"."</div>";
                }
            }

        ?>

        <div class="ui message">
            Novo por Aqui ?
            <a href="insertUser.php">Cadastre-se <i class="star outline icon"></i> !</a>
        </div>
    </div>
</div>
</body>
</html>