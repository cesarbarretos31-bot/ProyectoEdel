<?php

namespace App\Controllers;
use App\Models\ImagenModel;

class Carrusel extends BaseController
{
    public function index()
    {
        $model = new ImagenModel();
        // Obtiene todas las filas de la tabla
        $data['imagenes'] = $model->findAll();

        return view('carrusel_view', $data);
    }
}