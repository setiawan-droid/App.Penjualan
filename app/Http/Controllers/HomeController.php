<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan halaman Home
    public function index()
    {
        // Mengirim data ke view home.blade.php
        return view('home.index');
    }
}
