<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    //
    //login
    public function loginUser()
    {
        return view('auth/login');
    }
    //register
    public function register()
    {
        return view('auth/register');
    }

}
