<?php

namespace App\Models;
use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table            = 'imagenes_carrusel';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nombre_archivo', 'titulo', 'descripcion'];
}