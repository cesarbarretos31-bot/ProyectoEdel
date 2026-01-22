<?php

namespace App\Controllers;

class TestDB extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        if ($db->connID) {
            return "✅ Conectado correctamente a la base de datos en Railway";
        } else {
            return "❌ Error al conectar a la base de datos";
        }
    }
}
