<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestDB extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();

            // Ejecutar una consulta simple
            $query = $db->query('SELECT 1');

            if ($query) {
                return "✅ Conexión a la base de datos exitosa";
            }

            return "❌ No se pudo ejecutar consulta";
        } catch (\Throwable $e) {
            return "❌ Error: " . $e->getMessage();
        }
    }
}
