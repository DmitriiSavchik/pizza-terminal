<?php

namespace MyProject\Models\Sizes;

use MyProject\Models\ActiveRecordEntity;

class Size extends ActiveRecordEntity
{
    protected static function getTableName(): string
    {
        return 'sizes';
    }
}