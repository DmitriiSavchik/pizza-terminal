<?php

namespace MyProject\Models\Sauces;

use MyProject\Models\ActiveRecordEntity;

class Sauce extends ActiveRecordEntity
{
    protected static function getTableName(): string
    {
        return 'sauces';
    }
}