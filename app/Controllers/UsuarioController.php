<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    public function guardar()
    {
        $usuarioModel = new UsuarioModel();

        $data = [
            'nombre'    => $this->request->getPost('nombre'),
            'correo'    => $this->request->getPost('correo'),
            'password'  => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'creado_en' => date('Y-m-d H:i:s'),
        ];

        if ($usuarioModel->insert($data)) {
            return '✅ Usuario guardado correctamente';
        } else {
            return '❌ Error al guardar usuario';
        }
    } // 👈 ESTA LLAVE FALTABA

    public function listar()
    {
        $usuarioModel = new UsuarioModel();
        return $this->response->setJSON(
            $usuarioModel->findAll()
        );
    }

    public function obtener($id)
    {
        $usuarioModel = new UsuarioModel();
        return $this->response->setJSON(
            $usuarioModel->find($id)
        );
    }

    public function actualizar($id)
    {
        $usuarioModel = new UsuarioModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $usuarioModel->update($id, $data);

        return $this->response->setJSON([
            'ok' => true
        ]);
    }

    public function eliminar($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuarioModel->delete($id);

        return $this->response->setJSON([
            'ok' => true
        ]);
    }
}
