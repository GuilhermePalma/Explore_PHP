<?php
class HandlerDatabase{

    public $connection;


    public function OpenConnection(){
        try
        {
            // Configura a Conexão e Habilita a Obtenção de Erros
            $connection = new PDO("mysql: host=localhost;dbname=crud_php",
            "admin", "admin");
            $connection->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

            // Atribui à Variavel da Classe a Conexão
            $this->connection = $connection;

        } catch (PDOException $ex) {
            throw new Exception("Erro na Conexão com o Banco de Dados.".
                "Exceção: ".$ex->getMessage());
            $connection = null;
        }
    }

}
?>