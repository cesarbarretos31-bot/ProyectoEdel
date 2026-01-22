<?php

namespace App\Controllers;

/**
 * Controlador de Formulario Dinámico
 * Este controlador valida datos sin interactuar con MySQL.
 */
class Formulario extends BaseController
{
    // Cargamos los helpers necesarios para el formulario y las URLs
    protected $helpers = ['form', 'url'];

    /**
     * Muestra el formulario
     */
    public function index()
    {
        return view('formulario_view');
    }

    /**
     * Procesa la validación de los datos
     */
    public function procesar()
    {
        // 1. Definición de reglas ultra estrictas (Dinámicas)
        $reglas = [
            'nombre'   => [
                'rules'  => 'required|alpha_space|min_length[3]',
                'errors' => [
                    'required'    => 'El nombre es obligatorio.',
                    'alpha_space' => 'El nombre solo puede contener letras y espacios.',
                    'min_length'  => 'El nombre debe tener al menos 3 caracteres.'
                ]
            ],
            'email'    => 'required|valid_email',
            'edad'     => 'required|is_natural_no_zero|less_than[120]',
            'precio'   => 'required|decimal',
            'fecha'    => 'required|valid_date[Y-m-d]',
            'password' => 'required|min_length[8]|alpha_numeric_punct',
            'url_perfil' => 'permit_empty|valid_url',
            // Validación de archivo (Imagen)
            'foto'     => [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Debes subir una imagen.',
                    'max_size' => 'La foto es demasiado pesada (Máx 2MB).',
                    'is_image' => 'El archivo debe ser una imagen real.',
                    'mime_in'  => 'Solo se permiten formatos JPG o PNG.'
                ]
            ]
        ];

        // 2. Ejecutar la validación
        if (!$this->validate($reglas)) {
            // Si falla: Regresamos al formulario enviando los errores y los datos escritos (old input)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Si la validación tiene éxito:
        // Aquí podrías procesar los datos (ej. enviar un correo), pero no tocamos BD.
        $datosRecibidos = $this->request->getPost();
        
        return "
            <div style='font-family: sans-serif; padding: 20px;'>
                <h1 style='color: green;'>✅ ¡Validación Exitosa!</h1>
                <p>Los datos han pasado todos los filtros dinámicos correctamente.</p>
                <hr>
                <h3>Datos validados:</h3>
                <ul>
                    <li><strong>Nombre:</strong> " . esc($datosRecibidos['nombre']) . "</li>
                    <li><strong>Email:</strong> " . esc($datosRecibidos['email']) . "</li>
                    <li><strong>Edad:</strong> " . esc($datosRecibidos['edad']) . "</li>
                    <li><strong>Precio:</strong> " . esc($datosRecibidos['precio']) . "</li>
                </ul>
                <br>
                <a href='" . base_url('formulario') . "'>Volver al formulario</a>
            </div>
        ";
    }
}