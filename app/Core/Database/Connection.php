<?php 

namespace Core\Database;

use PDO;

class Connection extends PDO
{
    public function __construct()
    {
        parent::__construct(config('DB_DSN'), config('DB_USER'), config('DB_PASSWORD'), [
            parent::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="TRADITIONAL"',
            parent::ATTR_DEFAULT_FETCH_MODE => parent::FETCH_ASSOC,
            parent::ATTR_ERRMODE => parent::ERRMODE_EXCEPTION
        ]);
    }
}