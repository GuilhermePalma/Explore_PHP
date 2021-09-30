<form method="POST">
    <label>Nome</label>
    <input type="text" name="name">
    <br/>
    <label>Email</label>
    <input type="text" name="email">
    <br/>
    <br/>
    <input type="Submit" name="delete" value="Excluir">
</form>

<?php
// Verifica se a Variavel foi Atribuida
if(isset($_POST['name'])){
    include_once "../Database/DAO/UserDAO.php";
    include_once "../Model/User.php";

    // Instancia e Valida os Campos
    $user = new User($_POST['name'], $_POST['email'], );
    $user->ValidationEmail();
    $user->ValidationName();

    // Mostra na Tela caso haja algum erro
    $error_validation = $user->error_validation;
    if($error_validation != ""){
        echo $error_validation;
        return;
    }

    $userDAO = new UserDAO();
    $result_sql = $userDAO->DeleteUser($user->name, $user->email);
    if($result_sql == ""){
        // todo: obter detalhes do usuario após a atualização
        echo "Usuario <b>'". $user->name ."'</b> Excluido com Sucesso !"."<br/>";
        echo "<a href='../index.html'>Voltar ao Inicio</a>";
    } else {
        echo "Usuario não Excluido no Sistema."."<br/>";
        echo $result_sql;
    }
}
?>