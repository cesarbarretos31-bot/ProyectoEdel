<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    public function guardar()
    {
        $usuarioModel = new UsuarioModel();

        // Recibir datos del formulario
        $data = [
            'nombre'    => $this->request->getPost('nombre'),
            'correo'    => $this->request->getPost('correo'),
            'password'  => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'creado_en' => date('Y-m-d H:i:s'),
        ];

        // Guardar en BD
        if ($usuarioModel->insert($data)) {
            return '✅ Usuario guardado correctamente';
        } else {
            return '❌ Error al guardar usuario';
        }
    }
}
