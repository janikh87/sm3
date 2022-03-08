<?php

declare(strict_types=1);

namespace App\Db;

use App\Config\Db;

class Connection
{
    private ?\PDO $db = null;

    public function __construct()
    {
        try {
            $dsn = 'mysql:host=' . Db::HOST . ';dbname=' . Db::DATABASE . ';charset=' . Db::CHARSET;
            $this->db = new \PDO($dsn, Db::USER, Db::PASSWORD,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
        } catch (\PDOException $exception) {
            die('DB error: '.$exception->getMessage());
        }
    }

    public function getConnection(): \PDO
    {
        return $this->db;
    }



}
