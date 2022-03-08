<?php

declare(strict_types=1);

namespace App\Models;

interface Query {

    public static function getTableName(): string;

}
