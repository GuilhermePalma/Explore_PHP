<?php
class HomeController {

    public $title;

    private $path_utils = VIEWS_PATH . "\\utils";
    private $path_home = VIEWS_PATH . "\\Home";

    public function index(){
        $this->title = "Inicio - Explore PHP";

        require_once $this->path_utils."\\header.php";
        require_once $this->path_home . "\\home_page.php";
        require_once $this->path_utils."\\footer.php";
    }

}
?>