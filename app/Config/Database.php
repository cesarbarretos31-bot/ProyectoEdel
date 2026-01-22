<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public string $defaultGroup = 'default';

    public array $default = [
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

        // 🔥 Railway MySQL
        $this->default['hostname'] = getenv('MYSQLHOST');
        $this->default['username'] = getenv('MYSQLUSER');
        $this->default['password'] = getenv('MYSQLPASSWORD');
        $this->default['database'] = getenv('MYSQLDATABASE');
        $this->default['port']     = getenv('MYSQLPORT') ?: 3306;
    }
}
