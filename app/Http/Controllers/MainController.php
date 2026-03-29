<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
