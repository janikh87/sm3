<?php

declare(strict_types=1);

namespace App\Models;

use App\Db\Connection;

class UserQuery implements Query
{
    protected \PDO $conn;

    public function __construct(Connection $connection)
    {
        $this->conn = $connection->getConnection();
    }

    public static function getTableName(): string
    {
        return 'user';
    }

    public function getUserByEmail(string $email)
    {
        $query = $this->conn->prepare("SELECT * FROM " .self::getTableName() ." WHERE email = :email");
        $query->bindParam(':email', $email, \PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(\PDO::FETCH_OBJ);
    }

}
