<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    public function index()
    {
        $model = new UsuarioModel();
        $data['usuarios'] = $model->findAll();

        return view('usuarios/index', $data);
    }

    public function crear()
    {
        return view('usuarios/crear');
    }

    public function guardar()
    {
        $model = new UsuarioModel();

        $model->save([
            'nombre'    => $this->request->getPost('nombre'),
            'correo'    => $this->request->getPost('correo'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'creado_en' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/usuarios');
    }

    public function editar($id)
    {
        $model = new UsuarioModel();
        $data['usuario'] = $model->find($id);

        return view('usuarios/editar', $data);
    }

    public function actualizar($id)
    {
        $model = new UsuarioModel();

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

        $model->update($id, $data);

        return redirect()->to('/usuarios');
    }

    public function eliminar($id)
    {
        $model = new UsuarioModel();
        $model->delete($id);

        return redirect()->to('/usuarios');
    }
}
