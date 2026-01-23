<?php

namespace App\Controllers;

use App\Models\ImagenModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Formulario extends BaseController
{
    // Habilitamos los helpers necesarios para el host
    protected $helpers = ['form', 'url'];

    /**
     * Muestra la vista del formulario
     */
    public function index()
    {
        return view('formulario_view');
    }

    /**
     * PROCESO PRINCIPAL: Valida y guarda en el Host
     */
    public function procesar()
    {
        // 1. Reglas de validación estrictas
        $reglas = [
            'titulo' => 'required|min_length[3]|max_length[100]',
            'desc'   => 'permit_empty|max_length[255]',
            'foto'   => [
                'rules' => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Debes seleccionar una imagen.',
                    'is_image' => 'El archivo debe ser una imagen real.',
                    'max_size' => 'La imagen no debe pesar más de 2MB.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Manejo del archivo en el servidor
        $img = $this->request->getFile('foto');
        
        if ($img->isValid() && ! $img->hasMoved()) {
            // Nombre aleatorio para evitar conflictos en el servidor
            $newName = $img->getRandomName();
            
            // Ruta física en el host (Carpeta public/img)
            $path = FCPATH . 'img';

            // Verificamos si la carpeta existe, si no, la creamos con permisos
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // Movemos la imagen físicamente
            $img->move($path, $newName);

            // 3. Guardado en la Base de Datos del Host
            $model = new ImagenModel();
            try {
                $model->save([
                    'nombre_archivo' => $newName,
                    'titulo'         => $this->request->getPost('titulo'),
                    'descripcion'    => $this->request->getPost('desc')
                ]);

                return redirect()->to('/carrusel')->with('success', 'Imagen subida correctamente.');
            } catch (\Exception $e) {
                return "Error al guardar en la base de datos: " . $e->getMessage();
            }
        }

        return "Error crítico al procesar el archivo.";
    }

    /**
     * PRUEBA 1: Verificar conexión a BD en Railway
     */
    public function test_db()
    {
        try {
            $db = \Config\Database::connect();
            $query = $db->query("SELECT VERSION() as version");
            $row = $query->getRow();
            return "✅ Conexión a BD Exitosa. Versión de MySQL: " . $row->version;
        } catch (\Exception $e) {
            return "❌ Error de conexión: " . $e->getMessage();
        }
    }

    /**
     * PRUEBA 2: Verificar permisos de escritura en la carpeta public/img
     */
    public function test_folder()
    {
        $path = FCPATH . 'img/test_permisos.txt';
        $content = "Prueba de escritura en Railway: " . date('Y-m-d H:i:s');

        if (file_put_contents($path, $content)) {
            return "✅ ¡Escritura exitosa! El host permite guardar archivos en public/img.<br>URL: " . base_url('img/test_permisos.txt');
        } else {
            return "❌ Error de permisos: No se pudo escribir en la carpeta. Verifica la configuración del Volume en Railway.";
        }
    }
}