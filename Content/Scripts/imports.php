<?php
class Imports
{
    public function import($name_import){
        switch ($name_import) {
            case 'semantic_ui_css':
                // Adiciona o Arquivo CSS
                return file_get_contents(CSS_PATH."\\Semantic_UI\\semantic.min.css");

            case 'semantic_ui_js':
                return file_get_contents(CSS_PATH."\\Semantic_UI\\semantic.min.js");

            case 'custom_css':
                // Adiciona o Arquivo CSS
                return file_get_contents(CSS_PATH."\\customCss.css");

            case 'dropdown_js':
                // Adiciona o Arquivo Javascript
                return file_get_contents(SCRIPT_PATH."\\HandlerDropdown.js");

            default:
                return;
        }
    }
}
?>