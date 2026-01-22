<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestDB extends Controller
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            echo "✅ Conectado correctamente a la base de datos";
        } catch (\Throwable $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    }
}
