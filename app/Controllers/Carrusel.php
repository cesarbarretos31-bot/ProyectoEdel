<?php

namespace App\Controllers;

use App\Models\ImagenModel;
use CodeIgniter\Controller;

class Carrusel extends BaseController
{
    // 1. Mostrar el carrusel (Tu código original)
    public function index()
    {
        $model = new ImagenModel();
        $data['imagenes'] = $model->findAll();

        return view('carrusel_view', $data);
    }

    // 2. Mostrar el formulario de subida
    public function nuevo()
    {
        return view('carrusel_upload');
    }

    // 3. Procesar la imagen y guardar
    public function guardar()
    {
        // Validaciones para asegurar que es una imagen real
        $rules = [
            'titulo' => 'required|min_length[3]',
            'imagen' => [
                'rules' => 'uploaded[imagen]'
                    . '|is_image[imagen]'
                    . '|mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[imagen,5096]', // Máximo 5MB
            ],
        ];

        if (! $this->validate($rules)) {
            // Si falla, regresa con los errores
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Obtener el archivo del formulario
        $img = $this->request->getFile('imagen');

        // Verificar que el archivo es válido y no se ha movido aún
        if ($img->isValid() && ! $img->hasMoved()) {
            
            // Generar un nombre aleatorio para evitar archivos con mismo nombre
            $nuevoNombre = $img->getRandomName();

            // Mover la imagen a la carpeta public/img
            $img->move(FCPATH . 'img', $nuevoNombre);

            // Guardar la información en la base de datos
            $model = new ImagenModel();
            $model->insert([
                'nombre_archivo' => $nuevoNombre,
                'titulo'         => $this->request->getPost('titulo'),
                'descripcion'    => $this->request->getPost('descripcion'),
            ]);

            return redirect()->to(site_url('carrusel'))->with('success', 'Imagen subida correctamente');
        }

        return redirect()->back()->with('error', 'Hubo un error al subir el archivo.');
    }
}