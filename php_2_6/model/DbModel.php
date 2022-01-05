<?php

namespace app\model;
use app\engine\Db;

abstract class DbModel extends Model
{
    abstract public static function getTableName(); // абстрактный метод не соджержит тела, а только название ф-ции
    //СЛЕДИТ за тем, чтобы метод был определен в классе-наследнике

    public static function getLimit($page) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";

        return Db::getInstance()->queryLimit($sql, $page);
    }

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

        foreach ($this->props as $key => $value) { // Добавили после $this ->props,
                                                  // иначе не будет доступа к приватным полям
            //if ($key == 'id') continue; //УСЛОВИЕ при props вообще не нужно
           //$params[":{$key}"] = $value; //ВМЕСТО $value - строка ниже, нужное имя поля по ключу

//            var_dump($this);
//            var_dump($key);

            $params[":{$key}"] = $this->$key; // ":{$key}"] это получится :имя_ключа;
            // $this->$key  это обращение к значению поля по ключу, который равен ключу в пропсах

            //$params[":" . $key] = $this->$key;
            $columns[] = "$key";
        }

        $columns = implode(", ", $columns); // Сделать из массива строку с запятой

        $values = implode(", ", array_keys($params)); // Сделать из ключей в массиве строку
        // Результат ':name, :category_id, :price, :description'

        $tableName = static::getTableName();

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values});";
        Db::getInstance()->execute($sql, $params);

        $this->id = Db::getInstance()->lastInsertId();

        return $this;
    }

// DELETE -----------------------

    public function delete($id) {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id;";

        return Db::getInstance()->execute($sql, ['id' => $id]);
    }

// UPDATE -----------------------
    public function update() {
        $params = [];
        $columns = [];
        foreach ($this->props as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $this->$key;
            $columns[] .= "`{$key}` = :{$key}";
            $this->props[$key] = false;
        }

        $columns = implode(", ", $columns);
        $params['id'] = $this->id;
//        var_dump($params);
//        var_dump($columns);
        $tableName = static::getTableName();
        $sql = "UPDATE `{$tableName}` SET {$columns} WHERE `id` = :id";
        //TODO сбросить props в исходное если изменение произойдет
        Db::getInstance()->execute($sql, $params);
        return $this;
    }

// НАЙТИ ПО ОПРЕДЕЛЕННОМУ полю = имени столбца в БД -----------------------------------------------------

    public function getWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field}` = :value";

        return Db::getInstance()->queryOneObj($sql, ['value' => $value], static::class);
    }

    // НАЙТИ ПО ОПРЕДЕЛЕННОМУ полю = имени столбца в БД  еще полю = имени-----------------------------------------------------

    public function getWhereAnd($field1, $field2, $value1, $value2) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field1}` = :value1 AND `{$field2}` = :value2";

        return Db::getInstance()->queryOneObj($sql, ['value1' => $value1, 'value2' => $value2,], static::class);
    }

// Посчитать сумму по определенному полю в БД -----------------------------------------------------

    public static function getCountWhere($counted, $field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT SUM({$counted}) AS count FROM {$tableName} WHERE `{$field}` = :value;";

        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }

}