<?php

namespace App\Controllers;

class Formulario extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index()
    {
        return view('formulario_view');
    }

    public function procesar()
    {
        // Definimos todas las reglas de validación posibles
        $reglas = [
            'nombre'   => 'required|alpha_space|min_length[3]',
            'email'    => 'required|valid_email|is_unique[usuarios.email]', // valida formato y que sea único
            'edad'     => 'required|is_natural_no_zero|less_than[120]',
            'password' => 'required|min_length[8]|alpha_numeric_punct',
            'fecha'    => 'required|valid_date[Y-m-d]',
            'precio'   => 'required|decimal',
            'ip'       => 'permit_empty|valid_ip',
            'url'      => 'permit_empty|valid_url',
            'foto'     => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($reglas)) {
            // Si falla, regresa al formulario con los errores y lo que el usuario ya escribió
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Si pasa la validación
        return "¡Datos validados correctamente!";
    }
}