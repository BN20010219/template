<?php

namespace App\Http\Controllers;

use App\Core\Application;
use App\Core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "Autobots"
        ];
        return $this->render('home', $params);
    }

    public function contact()
    {
        return $this->render('contact',);
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'Handling submitted data';
    }
}
