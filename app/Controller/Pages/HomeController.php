<?php

namespace App\Controller\Pages;

use \App\Model\Entity\Organization;
use \App\Utils\View;

class HomeController extends DefaultPage
{

    public static function index()
    {
        $organization_test = new Organization();

        $content_view = View::renderView('Home/Home', [
            'name'        => $organization_test->name,
            'description' => $organization_test->description,
            'site'        => $organization_test->site,
        ]);

        return self::getDefaultPage("Home Page", $content_view);
    }

}
