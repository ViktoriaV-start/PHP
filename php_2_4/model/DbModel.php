<?php

namespace app\model;
use app\engine\Db;

abstract class DbModel extends Model
{
    abstract public static function getTableName(); // абстрактный метод не соджержит тела, а только название ф-ции
    //СЛЕДИТ за тем, чтобы метод был определен в классе-наследнике

// getAll -----------------------
    public static function getAll() // получить все данные
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

// getOne -----------------------
    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return Db::getInstance()->queryOneObj($sql, ['id' => $id], static::class);
    }

// INSERT -----------------------
    public function insert() {
        $params = [];
        $columns = [];
        $values = "";

        foreach ($this as $key => $value) {
            if ($key == 'id') continue;
            $params[":{$key}"] = $value;
            $columns[] = "$key";
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        $tableName = static::getTableName();

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values});";
        var_dump($sql);
        Db::getInstance()->execute($sql, $params);

        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

// DELETE -----------------------

    public function delete($id) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id;";
        var_dump($sql);
        Db::getInstance()->execute($sql, ['id' => $id]);
    }

// UPDATE в работе -----------------------
    public function update() {
        $tableName = $this->getTableName();
        $sql = "INSERT";
        // ДОДЕЛАТЬ $this->db->update($sql);
    }
}