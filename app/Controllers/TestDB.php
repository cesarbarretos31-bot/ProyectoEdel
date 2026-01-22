<?php

namespace App\Controllers;

class TestDB extends BaseController
{
 public function testdb()
{
    try {
        $db = \Config\Database::connect();
        $db->query('SELECT 1');
        return '✅ Conexión OK con Railway MySQL';
    } catch (\Throwable $e) {
        return '❌ Error: ' . $e->getMessage();
    }
}
}
   
