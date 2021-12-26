<?php

namespace App\Controller\Pages;

use \App\Model\Entity\Organization;
use \App\Utils\View;

class AboutController extends DefaultPage
{

    public static function getAbout()
    {
        $organization_test = new Organization();

        $content_view = View::renderView('About/About', [
            'name'        => $organization_test->name,
            'site'        => $organization_test->site
        ]);

        return self::getDefaultPage("About Page", $content_view);
    }

}
