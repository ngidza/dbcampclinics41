<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboratoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:laboratory');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laboratory');
    }
}
