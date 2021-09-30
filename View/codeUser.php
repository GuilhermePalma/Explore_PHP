<form method="POST">
    <label>Nome</label>
    <input type="text" name="name">
    <br/>
    <label>Email</label>
    <input type="text" name="email">
    <br/>
    <br/>
    <input type="Submit" name="searchCode" value="Pesquisar">
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
    $result_sql = $userDAO->GetUser($user->name, $user->email);
    if(is_array($result_sql)){
        echo "Codigo do Usuario <b>'".$result_sql[0]['name']."'</b> é: <b>".
        $result_sql[0]['id_user']."</b><br/>";
    } else {
        echo "Codigo do Usuario não Disponivel."."<br/>";
        echo $result_sql;
    }
}
?>