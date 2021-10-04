<?php
class UserController{

    public $title;

    private $path_utils = VIEWS_PATH . "\\utils";
    private $path_user = VIEWS_PATH . "\\User";

    public function index(){
        $this->title = "Usuario - Login";

        require_once $this->path_utils."\\header.php";
        require_once $this->path_user . "\\selectUser.php";
        require_once $this->path_utils."\\footer.php";
    }


    public function singup(){
        $this->title = "Usuario - Cadastro";

        require_once $this->path_utils."\\header.php";
        require_once $this->path_user . "\\insertUser.php";
        require_once $this->path_utils."\\footer.php";
    }

    public function login(){
        $this->title = "Usuario - Login";

        require_once $this->path_utils."\\header.php";
        require_once $this->path_user . "\\selectUser.php";
        require_once $this->path_utils."\\footer.php";
    }

    public function update(){
        $this->title = "Usuario - Atualizar";

        require_once $this->path_utils."\\header.php";
        require_once $this->path_user . "\\updateUser.php";
        require_once $this->path_utils."\\footer.php";
    }

    public function delete(){
        $this->title = "Usuario - Exclusão";

        require_once $this->path_utils."\\header.php";
        require_once $this->path_user . "\\deleteUser.php";
        require_once $this->path_utils."\\footer.php";
    }

    public function listUser(){
        $this->title = "Usuario - Listagem";

        require_once $this->path_utils."\\header.php";
        require_once $this->path_user . "\\deleteUser.php";
        require_once $this->path_utils."\\footer.php";
    }

}
?>