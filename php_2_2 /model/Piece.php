<?php

namespace app\model;


class Piece extends Model {

    public function __construct($name = null,
                                $quantity = null,
                                $price = null,//может быть вычисляемым в классе-наследнике,
        // поэтому передвинула в конец, включить в конструктор было надо, иначе не работало
                                $measure = 'piece')
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