<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:nurse');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nurse');
    }
}

