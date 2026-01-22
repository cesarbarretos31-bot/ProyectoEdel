<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public $default = [];

    public function __construct()
    {
        parent::__construct();

        $this->default = [
          'DSN'      => '',
        'hostname' => 'mysql.railway.internal', 
        'username' => 'root',
        'password' => 'WZKuoXKFRtWGisNdBztfWpXiEGeqPuQE',
        'database' => 'railway',
        'DBDriver' => 'MySQLi',  // <--- ESTO ARREGLA EL ERROR DEL DRIVER
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true, // Lo dejamos en true para ver errores si fallara algo mas
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306, // <--- CAMBIA ESTO POR TU MYSQLPORT (es un numero)
    ];
    }
}
