<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'correo',
        'password',
        'creado_en',
    ];

    protected $useTimestamps = false;

    protected $returnType = 'array';
}
