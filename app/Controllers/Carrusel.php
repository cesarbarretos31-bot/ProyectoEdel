<?php

namespace App\Controllers;

class Carrusel extends BaseController
{
    public function index()
    {
        $data = [
            'imagenes' => [
                [
                    'src'    => 'foto1.jpg', // Verifica que no sea FOTO1.JPG o foto1.png
                    'alt'    => 'Imagen 1',
                    'titulo' => 'Deslizante 1',
                    'desc'   => 'Descripción uno'
                ],
                [
                    'src'    => 'foto2.jpg',
                    'alt'    => 'Imagen 2',
                    'titulo' => 'Deslizante 2',
                    'desc'   => 'Descripción dos'
                ],
                [
                    'src'    => 'foto3.jpg',
                    'alt'    => 'Imagen 3',
                    'titulo' => 'Deslizante 3',
                    'desc'   => 'Descripción tres'
                ],
            ]
        ];

        return view('carrusel_view', $data);
    }
}