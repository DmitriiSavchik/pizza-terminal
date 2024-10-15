<?php

namespace MyProject\Models\Pizzas;

use MyProject\Models\ActiveRecordEntity;

class Pizza extends ActiveRecordEntity
{
    protected static function getTableName(): string
    {
        return 'pizzas';
    }
}