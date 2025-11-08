<?php

namespace App\Http\Controllers;

use App\Models\Tourist;
use Illuminate\Http\Request;

class TouristController extends Controller
{
    /**
     * Display a listing of the tourists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourists = Tourist::latest()->paginate(10);
        return view('admin.tourists.index', compact('tourists'));
    }
}