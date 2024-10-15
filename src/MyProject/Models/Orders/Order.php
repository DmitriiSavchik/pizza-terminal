<?php

namespace MyProject\Models\Orders;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Services\Db;

class Order extends ActiveRecordEntity
{
    /** @var int */
    protected $pizzaId;

    /** @var int */
    protected $sizeId;

    /** @var int */
    protected $sauceId;

    /** @var int */
    protected $summary;
    
    public function setPizzaId(int $pizzaId)
    {
        $this->pizzaId = $pizzaId;
    }
    
    public function setSizeId(int $sizeId)
    {
        $this->sizeId = $sizeId;
    }
    
    public function setSauceId(int $sauceId)
    {
        $this->sauceId = $sauceId;
    }
    
    public function setSummary(float $summary)
    {
        $this->summary = $summary;
    }

    public function save(): void
    {
        $db = Db::getInstance();
        
        $sql = 'INSERT INTO `' . static::getTableName() . '` (id_pizzas, id_sizes, id_sauces, summary) 
                VALUES (:pizzaId, :sizeId, :sauceId, :summary)';
        
        $db->query($sql, [
            ':pizzaId' => $this->pizzaId,
            ':sizeId' => $this->sizeId,
            ':sauceId' => $this->sauceId,
            ':summary' => $this->summary
        ]);
    }

    protected static function getTableName(): string
    {
        return 'orders';
    }
}
