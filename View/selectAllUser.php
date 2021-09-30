<?php

include_once "../Database/DAO/UserDAO.php";

$userDAO = new UserDAO();
$result_sql = $userDAO->SelectAll();

if(!$result_sql || !is_array($result_sql)){
    echo "Nenhum dado encontrado"."<br/>";
    echo $result_sql;
} else {
    /* Criação da Tabela e da Parte Superior*/
    echo "<table border='1.5px' align='center'>
    <tr>
        <th width='50px' align='center'>Id</th>
        <th width='100px'>Nome</th>
        <th width='100px'>Email</th>
        <th width='100px'>Detalhes</th>
        <th width='100px'>Alterar</th>
        <th width='100px'>Excluir</th>
    <tr>";

    foreach($result_sql as $key => $value){

		echo "<tr>";
        echo "<th width='50px' align='center'>".$value['id_user']."</th>";
        echo "<th width='50px' align='center'>".$value['name']."</th>";
        echo "<th width='50px' align='center'>".$value['email']."</th>";
        echo "<th width='50px' align='center'><a href='#'>Detalhes</a></th>";
        echo "<th width='50px' align='center'><a href='#'>Alterar</a></th>";
        echo "<th width='50px' align='center'><a href='#'>Excluir</a></th>";
		echo "</tr>";
    }
    echo "</table>";
    echo "<br/>"."<a href='../index.html'>Voltar ao Incio<a/>";
}
?>