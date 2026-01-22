<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    /**
     * Default database connection
     */
    public $default = [
        'DSN'      => '',
        'hostname' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    public function __construct()
    {
        parent::__construct();

        // 🔹 Railway / Producción
        if (getenv('RAILWAY_ENVIRONMENT')) {
            $this->default['hostname'] = getenv('MYSQLHOST');
            $this->default['username'] = getenv('MYSQLUSER');
            $this->default['password'] = getenv('MYSQLPASSWORD');
            $this->default['database'] = getenv('MYSQLDATABASE');
            $this->default['port']     = getenv('MYSQLPORT');
        }
        // 🔹 Local (XAMPP)
        else {
            $this->default['hostname'] = '127.0.0.1';
            $this->default['username'] = 'root';
            $this->default['password'] = '';
            $this->default['database'] = 'edel_db';
            $this->default['port']     = 3306;
        }
    }
}
