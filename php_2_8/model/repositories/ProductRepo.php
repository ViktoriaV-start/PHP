<?php

namespace app\model\repositories;

use app\model\Repository;
use app\model\entities\Product;

class ProductRepo extends Repository
{
    public function getTableName() { //имя таблицы в БД, к которой нужно обращаться
        return 'products';
    }
    protected function getEntityClass()
    {
        return Product::class;
    }
}