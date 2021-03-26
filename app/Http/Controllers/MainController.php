<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * @desc halaman utama website
     */
    public function index()
    {
        return view('main.main');
    }
}
