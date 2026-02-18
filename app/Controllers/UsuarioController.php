<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class UsuarioController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | VISTA FETCH
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('usuarios/fetch');
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD CLÁSICO (REDIRECT)
    |--------------------------------------------------------------------------
    */

    public function guardarVista()
    {
        $model = new UsuarioModel();

        $model->insert([
            'nombre'    => $this->request->getPost('nombre'),
            'correo'    => $this->request->getPost('correo'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'creado_en' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/usuarios');
    }

    public function actualizarVista($id)
    {
        $model = new UsuarioModel();

        $model->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
        ]);

        return redirect()->to('/usuarios');
    }

    public function eliminarVista($id)
    {
        $model = new UsuarioModel();
        $model->delete($id);

        return redirect()->to('/usuarios');
    }

    /*
    |--------------------------------------------------------------------------
    | API JSON PARA FETCH
    |--------------------------------------------------------------------------
    */

    public function listar()
    {
        $model = new UsuarioModel();
        return $this->response->setJSON($model->findAll());
    }

    public function obtener($id)
    {
        $model = new UsuarioModel();
        return $this->response->setJSON($model->find($id));
    }

    public function guardar()
    {
        $model = new UsuarioModel();

        $model->insert([
            'nombre'    => $this->request->getPost('nombre'),
            'correo'    => $this->request->getPost('correo'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'creado_en' => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON(['ok' => true]);
    }

    public function actualizar($id)
    {
        $model = new UsuarioModel();

        $model->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
        ]);

        return $this->response->setJSON(['ok' => true]);
    }

    public function eliminar($id)
    {
        $model = new UsuarioModel();
        $model->delete($id);

        return $this->response->setJSON(['ok' => true]);
    }
public function buscar()
{
    $model = new UsuarioModel();
    $texto = $this->request->getGet('q');

    $usuarios = $model
        ->groupStart()
            ->like('nombre', $texto)
            ->orLike('correo', $texto)
        ->groupEnd()
        ->findAll();

    return $this->response->setJSON($usuarios);
}


}
