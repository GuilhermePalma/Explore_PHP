<form method="POST">
    <label>Nome</label>
    <input type="text" name="name">
    <br/>
    <label>Email</label>
    <input type="text" name="email">
    <br/>
    <input type="Submit" name="insert" value="Inserir">
</form>

<?php
// Verifica se a Variavel foi Atribuida
if(isset($_POST['name'])){
    include_once "../Database/DAO/UserDAO.php";
    include_once "../Model/User.php";

    // Instancia e Valida os Campos
    $user = new User($_POST['name'], $_POST['email']);
    $user->ValidationEmail();
    $user->ValidationName();

    // Mostra na Tela caso haja algum erro
    $error_validation = $user->error_validation;
    if($error_validation != ""){
        echo $error_validation;
        return;
    }

    $userDAO = new UserDAO();
    $result_sql = $userDAO->InsertUser($user->name, $user->email);
    if($result_sql == ""){

        // Obtem os Dados Cadastrados do Banco de Dados
        $result_details = $userDAO->GetUser($user->name, $user->email);
        if(is_array($result_details)){
            echo "Usuario Inserido com Sucesso !"."<br/>";
            echo "Detalhes:"."<br/>";
            echo "ID do Usuario: ".$result_details[0]['id_user']."<br/>";
            echo "Nome: ".$result_details[0]['name']."<br/>";
            echo "Email: ".$result_details[0]['email']."<br/>";
            echo "<br/><a href='../index.html'>Voltar ao Inicio</a>";
        }
        else{
            echo "Não é Possivel Completar a Solicitação"."<br/>";
            echo $result_details;
        }
    } else {
        echo "Usuario não Inserido no Sistema."."<br/>";
        echo $result_sql;
    }
}
?>