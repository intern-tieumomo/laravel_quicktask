<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MyController extends Controller
{
    public function home()
    {
        return redirect('tasks');
    }

    public function changeLanguage($lang)
    {
        Session::put('lang', $lang);
        
        return redirect()->back();
    }
}

