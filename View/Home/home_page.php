<?php
    if (!defined('ROOT_PROJECT')) {
        //todo alterar para o controller de erro
        echo "Pagina não disponivel";
        exit;
    }

    include_once SCRIPT_PATH."\\imports.php";

    $import = new Imports();

    // todo: substituir por controller
    $go_user = VIEWS_PATH."\\User\\selectUser.php"
?>

<style type="text/css">
    <?php
        echo $import->import("custom_css");
    ?>
</style>

<div class="ui middle aligned stackable grid container height_window">
    <div class="row">
        <div class="center aligned column">
            <h1 class="ui header">Explore PHP</h1>
            <h2>Navegue e utilize um site feito em PHP.</h2>

            <a href="<?php echo $go_user; ?>"
                class="ui animated huge primary button"
                tabindex="0">
                <div class="visible content">Vamos Lá !</div>
                <div class="hidden content">
                    <i class="right arrow icon"></i>
                </div>
            </a>
        </div>
    </div>
</div>