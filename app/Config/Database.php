<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $defaultGroup = 'default';

    public $default = [];

    public function __construct()
    {
        parent::__construct();

        $this->default = [
            'DSN'      => '',
            'hostname' => env('MYSQLHOST'),
            'username' => env('MYSQLUSER'),
            'password' => env('MYSQLPASSWORD'),
            'database' => env('MYSQLDATABASE'),
            'DBDriver' => 'MySQLi', // ⛔ NO
            // 👇 CAMBIAR A:
            // 'DBDriver' => 'MySQLi',
            'DBDriver' => 'PDO',
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => (ENVIRONMENT !== 'production'),
            'charset'  => 'utf8mb4',
            'DBCollat' => 'utf8mb4_general_ci',
            'swapPre'  => '',
            'encrypt'  => false,
            'compress' => false,
            'strictOn' => false,
            'failover' => [],
            'port'     => env('MYSQLPORT'),
        ];
    }
}
