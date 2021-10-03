<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Cadastrados</title>

    <!-- Importação dos Scripts de CSS e JavaScript -->
    <link rel="stylesheet" type="text/css"
        href="../../Content/Css/Semantic_UI/semantic.min.css">
    <link rel="stylesheet" type="text/css"
        href="../../Content/Css/customCss.css">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

    <script src="../../Content/Css/Semantic_UI/semantic.min.js"></script>
    <script src="../../Content/Scripts/HandlerDropdown.js"></script>

</head>

<body>
<div class="ui container padding_end">
    <div class="ui menu">
        <div class="ui container">
            <a href="../../index.php" class="header item">
                Explore PHP
            </a>
            <a href="../../index.php" class="item">Inicio</a>

            <div class="ui pointing dropdown item" tabindex="0">
                Usuario
                <i class="dropdown icon"></i>
                <div class="menu transition hidden" tabindex="-1">
                    <a href="insertUser.php"
                        class="item">Cadastro</a>
                    <a href="selectUser.php"
                        class="item">Detalhes</a>
                    <a href="updateUser.php"
                        class="item">Atualizar</a>
                    <a href="deleteUser.php"
                        class="item">Excluir</a>
                    <div class="divider"></div>
                    <a href="selectAllUser.php"
                        class="active item">Listar Usuario</a>
                </div>
            </div>
        </div> <!-- div .ui container -->
    </div> <!-- div.ui menu -->

    <div class="ui segment">
        <h2 class="center">Listagem dos Usuarios Cadastrados</h2>

      <?php
        include_once "../../Database/DAO/UserDAO.php";

        $userDAO = new UserDAO();
        $result_sql = $userDAO->SelectAll();

        if(!is_array($result_sql)){
            echo "<div class='ui error message'>";
            echo "Não Foi Possivel Obter os Clientes"."<br />".$result_sql."</div>";
        } else {
            /* Criação da Tabela e da Parte Superior*/
            echo "<table class='ui five column green table'>".
                "<thead>"."<tr>".
                    "<th>Id</th>".
                    "<th>Nome</th>".
                    "<th>Email</th>".
                    "<th width='30px'>Detalhes</th>".
                    "<th width='30px'>Alterar</th>".
                    "<th width='30px'>Excluir</th>".
                "</tr>"."</thead>"."<tbody>";

            foreach($result_sql as $key => $value){
                echo "<tr>";
                echo "<td>".$value['id_user']."</td>";
                echo "<td>".$value['name']."</td>";
                echo "<td>".$value['email']."</td>";
                echo "<td width='30px'>"."<a href='selectUser.php'>".
                    "<i class='file alternate icon'></i>"."</a>"."</td>";
                echo "<td width='30px'>"."<a href='updateUser.php'>".
                    "<i class='edit icon'></i>"."</a>"."</td>";
                echo "<td width='30px'>"."<a href='deleteUser.php'>".
                    "<i class='trash alternate icon'></i>"."</a>"."</td>";
                echo "</tr>";
            }
            echo "</tbody>"."<tfoot>."."<tr>";
            echo "<th>"."Quantidade de Usuario"."</th>";
            echo "<th>"."<b>".count($result_sql)."</b>"."</th>";
            echo "<th>"."</th>"."<th>"."</th>"."<th>"."</th>"."<th>"."</th>";
            echo "</tr>"."</tfoot>"."</table>";
        }
      ?>
        <br/>

        <div class="ui grid">
            <div class="left floated left aligned six wide column">
                <a href="../../index.php" class="ui animated button"
                    tabindex="0">
                    <div class="visible content">Voltar ao Incio</div>
                    <div class="hidden content">
                        <i class="left arrow icon"></i>
                    </div>
                </a>
            </div>
            <div class="right floated right aligned six wide column">
                <a href="insertUser.php" class="ui animated button"
                    tabindex="0">
                    <div class="visible content">Novo Usuario</div>
                    <div class="hidden content">
                        <i class="right arrow icon"></i>
                    </div>
                </a>
            </div>
        </div>

    </div> <!-- div .ui segment -->
</div> <!-- div .ui container padding_end -->
</body>
</html>