<form method="POST">
    <label>ID do Usuario</label>
    <input type="number" name="id">
    <br/>
    <sub>Caso não Saiba, <a href="codeUser.php">Clique Aqui</a> para Consultar</sub>
    <br/>
    <label>Nome</label>
    <input type="text" name="name">
    <br/>
    <label>Email</label>
    <input type="text" name="email">
    <br/>
    <br/>
    <input type="Submit" name="update" value="Atualizar">
</form>

<?php
// Verifica se a Variavel foi Atribuida
if(isset($_POST['name'])){
    include_once "../Database/DAO/UserDAO.php";
    include_once "../Model/User.php";

    // Instancia e Valida os Campos
    $user = new User($_POST['name'], $_POST['email'], );
    $user->id_user = $_POST['id'];
    $user->ValidationEmail();
    $user->ValidationName();
    $user->ValidationID();

    // Mostra na Tela caso haja algum erro
    $error_validation = $user->error_validation;
    if($error_validation != ""){
        echo $error_validation;
        return;
    }

    $userDAO = new UserDAO();
    $result_sql = $userDAO->UpdateUser($user->id_user, $user->name, $user->email);
    if($result_sql == ""){
        // todo: obter detalhes do usuario após a atualização
        echo "Usuario Atualizado com Sucesso !"."<br/>";
        echo "<a href='../index.html'>Voltar ao Inicio</a>";
    } else {
        echo "Usuario não Atualizado no Sistema."."<br/>";
        echo $result_sql;
    }
}
?>