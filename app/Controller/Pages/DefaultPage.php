<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class DefaultPage
{

    public static function getHeader()
    {
        return View::renderView('Utils/Header');
    }

    public static function getFooter()
    {
        return View::renderView('Utils/Footer');
    }

    public static function getDefaultPage($title, $content_view)
    {
        return View::renderView('Utils/DefaultPage', [
            'title'   => $title,
            'header'  => self::getHeader(),
            'render_content' => $content_view,
            'footer'  => self::getFooter(),
        ]);
    }

}
