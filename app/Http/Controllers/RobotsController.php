<?php

namespace App\Http\Controllers;

use MadWeb\Robots\Robots;

class RobotsController extends Controller
{
    public function __invoke(Robots $robots)
    {
        $robots->addUserAgent('*');

        if (app()->environment('production')) {
            // If on the live server, serve a nice, welcoming robots.txt.
            $robots->addDisallow('/invoices');
            //$robots->addDisallow('/cautare?*');
            $robots->addSitemap(url('sitemap.xml'));
        } else {
            // If you're on any other server, tell everyone to go away.
            $robots->addDisallow('/');
        }

        return response($robots->generate(), 200, ['Content-Type' => 'text/plain']);
    }
}
