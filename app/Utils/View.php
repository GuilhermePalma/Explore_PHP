<?php

namespace App\Utils;

class View
{

    /**
     * Variaveis padrões da View
     */
    private static $vars = [];

    /**
     * Metodo Responsavel por definir os dados iniciais da Classe
     *
     * @param  array $vars
     * @return void
     */
    public static function init($vars = [])
    {
        self::$vars = $vars;
    }

    /**
     * Retorna o Conteudo de uma VIew
     * @param stirng $name_view
     * @return string
     */
    private static function getContentView($name_view)
    {
        $path_file_html = __DIR__ . '/../../Resources/View/' . $name_view . '.html';

        return file_exists($path_file_html) ? file_get_contents($path_file_html) : '';
    }

    /**
     * Retorna o Conteudo Renderizado de uma View
     * @param string $name_view
     * @param array $array_atrr (string|numeric)
     * @return string
     *
     */
    public static function renderView($name_view, $array_atrr = [])
    {
        // Obtem o Conteudo das Views
        $content_view = self::getContentView($name_view);

        // Une as 2 Variaveis do Layout
        $array_atrr = array_merge(self::$vars, $array_atrr);

        // Obtem as Keys do array
        $keys = array_keys($array_atrr);

        // Mapeia e Formata as Chaves que serão substituidas na View
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);

        // Retorna a View Configurada com os Valores já substituidos
        return str_replace($keys, array_values($array_atrr), $content_view);
    }
}
