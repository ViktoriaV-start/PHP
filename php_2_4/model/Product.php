<?php

namespace app\model;
use app\engine\Db;

class Product extends DbModel {
    public $id;
    public $name;
    public $category_id;
    public $price;
    public $description;

    public function __construct($name = null, $category_id = null, $price = null, $description = null)
    {
        //parent::__construct(); // Писать, если используется I способ подключения БД,
        //здесь вызываем метод из родительского конструктора, где вызывается БД
        $this->name = $name;
        $this->category_id = $category_id;
        $this->price = $price;
        $this->description = $description;
    }

    public static function getTableName() { //имя таблицы в БД, к которой нужно обращаться
        return 'products';
    }
}