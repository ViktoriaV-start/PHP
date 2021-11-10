<?php

namespace app\model;


class Weighed extends Model {

    public function __construct($name = null,
                                $price = null,
                                $quantity = null,
                                $measure = 'kg')
    {
        parent::__construct(); // здесь вызываем метод из родительского конструктора, где вызывается БД
        $this->name = $name;
        $this->price = $price;
        $this->measure = $measure;
        $this->quantity = $quantity;
    }

    public function getTableName() {
        return 'products';
    }
}