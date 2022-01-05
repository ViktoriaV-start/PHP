<?php

namespace app\model;

use app\interfaces\IModel;
use app\engine\Db;

abstract class Model implements IModel// абстрактный класс общий функционал для всех наследников
{

    public $id;
    public $name;
    public $price;
    public $measure;
    public $quantity;
    public $total;

    protected $db;

    public function __construct(string $name = null,
                                string $measure = null,
                                int $quantity = null,
                                int $price = null)
    {
        $this->db = Db::getInstance(); // вызываем метод из класса Db = получить экземпляр Db
        $this->name = $name;
        $this->price = $price;
        $this->measure = $measure;
        $this->quantity = $quantity;
    }

    public function getTotal() {
        return $this->total = $this->quantity * $this->price;
    }

    abstract public function getTableName(); // абстрактный метод не соджержит тела, а только название ф-ции
    //СЛЕДИТ за тем, чтобы метод был определен в классе-наследнике

    public function getAll() // получить все данные
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql); // здесь пиши метод из класса Db
    }

    public function getOne($id) { // Ф-ция на получение
        // нодной записи из БД
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        return $this->db->queryOne($sql); // здесь пиши метод из класса Db
    }


    public function delete() { // Ф-ция на использование
        // нового объекта класса DB с ф-цией удалить

        $tableName = $this->getTableName();
        $sql = "DELETE WHERE id = {$this->id}";
        $this->db->execute($sql);
    }

    public function insert() {
        $tableName = $this->getTableName();
        $sql = "INSERT";
        $this->db->insert($sql);
    }
    public function update() {
        $tableName = $this->getTableName();
        $sql = "UPDATE";
        $this->db->update($sql);
    }
}