<?php

namespace App\Http\Controllers;

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
