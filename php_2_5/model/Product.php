<?php

namespace app\model;


class Product extends DbModel {
    protected $id; // Меняем с public на protected, методы __set/ __get позволят получить доступ
    protected $name;
    protected $category_id;
    protected $price;
    protected $description;


// ЭТО набор данных, чтобы иметь доступ к protected переменным при методе UPDATE,
// чтобы проверить, какие поля изменились
    protected $props = [
        'name' => false, // это означает, что поле не изменилось
        'category_id' => false,
        'price' => false,
        'description' => false

    ];


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