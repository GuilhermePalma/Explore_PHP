<?php

class User{

    public $name;
    public $email;
    public $id_user;

    public $error_validation = "";

    // Contrutor da Classe User
    public function __construct($name, $email){
       $this->name = $name;
       $this->email = $email;
    }

    // Valida se o Nome Instanciado é Valido
    public function ValidationName(){
        if(!is_string($this->name)){
            $this->error_validation = "O Nome tem que ser um Texto";
            return false;
        }

        // Validação Regex ---> Substitui o que não For Letras
        $regex_name = "/[^a-zA-Zà-úÀ-Ú\s]/";
        $result = preg_replace($regex_name, "", $this->name);

        if($result != $this->name){
            $this->error_validation = "Somente é permitido Letras no Nome";
            return false;
        } else if(strlen($this->name) < 3 || strlen($this->name) >= 80){
            $this->error_validation = "Somente é permitido de 3 à 80 Caracteres
            no Nome";
            return false;
        }
        return true;
    }

    // Valida se o Email Instanciado é Valido
    public function ValidationEmail(){
        if(!is_string($this->email)){
            $this->error_validation = "O Email tem que ser um Texto";
            return false;
        } else if(strlen($this->email) < 5 || strlen($this->email) >= 120){
            $this->error_validation = "Somente é permitido de 5 à 120 Caracteres
            no Email";
            return false;
        }

        // Validação Regex ---> Substitui o que não pertencer ao REGEX
        $regex_email ="/^[_a-z0-9-]+(\.[_a-z0-9\-]+)*\@[a-z0-9\-]+(\.[a-z0-9\-]+)*(\.[a-z]{2,4})$/i";
        if(!preg_match($regex_email, $this->email)){
            $this->error_validation = "O Email deve estar no seguinte ".
                "Formato: <br/>emailUsuario@******.xxx";
            return false;
        }
        return true;
    }

    // Valida o ID do Usuario
    public function ValidationID(){
        if($this->id_user <= 0){
            $this->error_validation = "O ID tem que ser maior que 0";
            return false;
        }
        return true;
    }
}
?>