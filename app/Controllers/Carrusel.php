<?php

namespace App\Controllers;

class Carrusel extends BaseController
{
    public function index()
    {
        // ... tus datos de imágenes ...
        $data = [
            'imagenes' => [
                [
                    'src' => 'foto1.jpg',
                    'alt' => 'Primera imagen',
                    'titulo' => 'Bienvenido',
                    'desc' => 'Descripción de la primera foto'
                ],
                [
                    'src' => 'foto2.jpg',
                    'alt' => 'Segunda imagen',
                    'titulo' => 'Nuestros Servicios',
                    'desc' => 'Descripción de la segunda foto'
                ],
                [
                    'src' => 'foto3.jpg',
                    'alt' => 'Tercera imagen',
                    'titulo' => 'Contáctanos',
                    'desc' => 'Descripción de la tercera foto'
                ],
            ]
        ];

        return view('carrusel_view', $data);
    }
}