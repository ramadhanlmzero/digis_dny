<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return redirect()->route('login');
    }
    public function any($any)
    {
        return view('errors.404');
    }
}
