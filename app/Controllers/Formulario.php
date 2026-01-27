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
        $reglas = [
            'nombre' => [
                'rules'  => 'required|alpha_space|min_length[3]|max_length[60]',
                'errors' => [
                    'required'    => 'El nombre es obligatorio.',
                    'alpha_space' => 'El nombre solo puede contener letras.',
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'El correo es obligatorio.',
                    'valid_email' => 'Correo no válido.',
                ]
            ],
            'edad' => [
                'rules'  => 'required|integer|greater_than_equal_to[18]|less_than_equal_to[99]',
                'errors' => [
                    'required' => 'La edad es obligatoria.',
                    'integer'  => 'La edad debe ser un número.',
                ]
            ],
            'precio' => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'decimal' => 'El precio debe ser numérico (ej. 99.99).'
                ]
            ],
            'fecha' => [
                'rules'  => 'required|valid_date',
                'errors' => [
                    'valid_date' => 'Fecha inválida.'
                ]
            ],
            'password' => [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'min_length' => 'La contraseña debe tener mínimo 8 caracteres.'
                ]
            ],
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        return redirect()->back()->with('success', '✅ Datos válidos. Todo correcto.');
    }
}
