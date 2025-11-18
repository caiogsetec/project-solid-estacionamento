<?php
namespace App\Infra\Database;

use SQLite3;

class Connection
{
    public static function get(): SQLite3
    {
        return new SQLite3(__DIR__ . '/../../../database.sqlite');
    }
}
