<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        // Cargamos la vista que contendrá los botones
        return view('home'); 
    }
}
