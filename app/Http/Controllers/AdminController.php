<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function games()
    {
        return view('admin.games');
    }
}
