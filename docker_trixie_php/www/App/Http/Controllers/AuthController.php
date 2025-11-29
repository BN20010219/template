<?php

namespace App\Http\Controllers;

use App\Core\Request;

class AuthController extends Controller
{
    
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        if($request->isPost()){
            return 'Handle Submitted Data';
        }
        $this->setLayout('auth');
        return $this->render('register');
    }
}