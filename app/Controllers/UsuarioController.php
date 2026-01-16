<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class UsuarioController extends Controller
{
    public function prueba()
    {
        $usuarioModel = new UsuarioModel();

        $data = [
            'nombre'    => 'Usuario Prueba',
            'correo'    => 'prueba' . time() . '@mail.com',
            'password'  => password_hash('123456', PASSWORD_DEFAULT),
            'creado_en' => date('Y-m-d H:i:s'),
        ];

        if ($usuarioModel->insert($data)) {
            return "✅ Usuario insertado correctamente";
        } else {
            return "❌ Error al insertar usuario";
        }
    }
}
