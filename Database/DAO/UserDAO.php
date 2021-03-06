<?php
include_once "../Database/ADO/HandlerDatabase.php";

class UserDAO{

    // Obtemm o Usuario a partir do Nome+Email OU pelo Id(Opcional)
    public function GetUser($user_name, $user_email, $user_id=0)
    {
        try{
            $database = new HandlerDatabase();
            $database->OpenConnection();
            $connection = $database->connection;

            // Prepara a Query SQL
            $sql_command = "";
            if($user_id > 0){
                $sql_command = $connection->prepare(
                    "SELECT * FROM user WHERE id_user=?");
                $sql_command->execute(array($user_id));
            }
            else {
                $sql_command = $connection->prepare(
                    "SELECT * FROM user WHERE name=? AND email=?");
                $sql_command->execute(array($user_name, $user_email));
            }


            // Cria um Array e Obtem os dados se Existirem
            $result = array();
            while($row = $sql_command->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }

            if (!$result) {
                return "Usuario não Cadastrado no Sistema";
            }
            return $result;
        }
        catch(Exception $ex){
            // Erro na Conexão com o Banco de Dados
            return $ex->getMessage();
        }
    }

    public function InsertUser($user_name, $user_email)
    {
        try{
            if(is_array($this->GetUser($user_name, $user_email))){
                return "Usuario já Cadastrado no Banco de Dados";
            }

            $database = new HandlerDatabase();
            $database->OpenConnection();
            $connection = $database->connection;

            // Prepara e Executa a query SQL
            $sql_command = $connection->prepare(
                "INSERT INTO user(name, email) VALUE (?,?)");

            if($sql_command->execute(array($user_name, $user_email))){
                // Inserção bem Sucedida
                return "";
            } else{
                return "Não foi Possivel Cadastrar o Usuario no Sistema";
            }
        }
        catch(Exception $ex){
            // Erro na Conexão com o Banco de Dados
            return $ex->getMessage();
        }
    }

    public function UpdateUser($user_id, $user_name, $user_email)
    {
        try{
            // Obtem o Usuario pelo ID e retorna caso tenha erro
            $result_sql = $this->GetUser("", "", $user_id);
            if(!is_array($result_sql)) return $result_sql;

            $database = new HandlerDatabase();
            $database->OpenConnection();
            $connection = $database->connection;

            // Prepara e Executa a query SQL
            $sql_command = $connection->prepare(
                "UPDATE user SET name=?, email=? WHERE id_user=?");

            if($sql_command->execute(array($user_name, $user_email, $user_id))){
                // Atualização bem sucedida
                return "";
            } else{
                return "Não foi Possivel Atualizar o Usuario no Sistema";
            }
        }
        catch(Exception $ex){
            // Erro na Conexão com o Banco de Dados
            return $ex->getMessage();
        }
    }

    public function DeleteUser($user_name, $user_email)
    {
        try{
            // Obtem o Usuario pelo ID e retorna caso tenha erro
            $result_sql = $this->GetUser($user_name, $user_email);
            if(!is_array($result_sql)) return $result_sql;

            // Pega o ID da unica posição no Array
            $id_user =$result_sql[0]['id_user'];

            $database = new HandlerDatabase();
            $database->OpenConnection();
            $connection = $database->connection;

            // Prepara e Executa a query SQL
            $sql_command = $connection->prepare("DELETE FROM user WHERE id_user=?");

            if($sql_command->execute(array($id_user))){
                // Atualização bem sucedida
                return "";
            } else{
                return "Não foi Possivel Atualizar o Usuario no Sistema";
            }
        }
        catch(Exception $ex){
            // Erro na Conexão com o Banco de Dados
            return $ex->getMessage();
        }
    }

    public function SelectAll()
    {
        try{
            $database = new HandlerDatabase();
            $database->OpenConnection();
            $connection = $database->connection;

            // Prepara e Executa a query SQL
            $sql_command = $connection->prepare("SELECT * FROM user");
            $sql_command->execute();

            // Cria um Array e Obtem os dados se Existirem
            $result = array();
            while($row = $sql_command->fetch(PDO::FETCH_ASSOC)){
                $result[] = $row;
            }

            if (!$result) {
                return "Dados não Encontrados no Sistema";
            }
            return $result;
        }
        catch(Exception $ex){
            // Erro na Conexão com o Banco de Dados
            return $ex->getMessage();
        }
    }
}
?>