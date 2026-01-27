<?php

namespace App\Controllers;

use App\Models\ImagenModel;
use CodeIgniter\Controller;

class Carrusel extends Controller
{
    // Mostrar carrusel
    public function index()
    {
        $model = new ImagenModel();
        $data['imagenes'] = $model->findAll();

        return view('carrusel_view', $data);
    }

    // Mostrar formulario de subida
    public function nuevo()
    {
        return view('carrusel_upload');
    }

    // Guardar imagen
    public function guardar()
    {
        helper(['form']);

        $rules = [
            'titulo' => 'required|min_length[3]',
            'imagen' => [
                'rules' =>
                    'uploaded[imagen]'
                    . '|is_image[imagen]'
                    . '|mime_in[imagen,image/jpg,image/jpeg,image/png,image/gif,image/webp]'
                    . '|ext_in[imagen,jpg,jpeg,png,gif,webp]'
                    . '|max_size[imagen,5120]',
                'errors' => [
                    'uploaded' => 'Debes seleccionar una imagen.',
                    'is_image' => 'El archivo no es una imagen válida.',
                    'mime_in'  => 'Formato no permitido.',
                    'ext_in'   => 'Extensión no permitida.',
                    'max_size' => 'La imagen supera el tamaño permitido (5MB).',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $imagen = $this->request->getFile('imagen');

        if (! $imagen->isValid() || $imagen->hasMoved()) {
            return redirect()->back()
                ->with('error', 'Error al procesar la imagen.');
        }

        // 🔐 Verificación extra REAL de imagen
        if (! getimagesize($imagen->getTempName())) {
            return redirect()->back()
                ->with('error', 'El archivo no es una imagen válida.');
        }

        $nombreSeguro = $imagen->getRandomName();

        // Mover imagen
        $imagen->move(FCPATH . 'img', $nombreSeguro);

        $model = new ImagenModel();
        $model->insert([
            'nombre_archivo' => $nombreSeguro,
            'titulo'         => esc($this->request->getPost('titulo')),
            'descripcion'    => esc($this->request->getPost('descripcion')),
        ]);

        return redirect()->to(site_url('carrusel'))
            ->with('success', 'Imagen subida correctamente');
    }
}
