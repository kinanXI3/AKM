<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function index()
    {
        return view('contoh.index');
    }

    public function create()
    {
        return view('contoh.create');
    }
}
