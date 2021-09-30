<form method="POST">
    <label>Nome</label>
    <input type="text" name="name">
    <br/>
    <label>Email</label>
    <input type="text" name="email">
    <br/>
    <input type="Submit" name="search" value="Pesquisar">
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

    if(!$result_sql || !is_array($result_sql)){
        echo "Nenhum dado encontrado"."<br/>";
        echo $result_sql;
        echo "<br/><a href='insertUser.php'>Clique aqui</a> para Realizar o Cadastro";
    }else{
        // Obtem do Array o Usuario Inserido
        foreach($result_sql as $key => $value){
            echo $value['id_user']." - ".$value['name']." - ".$value['email'];
            echo " - <a href='#'>Editar</a> | <a href='#'>Excluir</a>";
        }
    }
}
?>