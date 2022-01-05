<?php

namespace app\model;
use app\engine\Db;
use app\model\entities\Product;
use app\model\entities\User;
use app\model\entities\Cart;
use app\model\repositories\ProductRepo;
use app\interfaces\IModel;

abstract class Repository implements IModel
{


    public function getLimit($page) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";



        return Db::getInstance()->queryLimit($sql, $page);
    }

// getAll -----------------------
    public function getAll() // получить все данные
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";

        return Db::getInstance()->queryAll($sql);
    }

// getOne -----------------------
    public function getOne($id) {

        $tableName = $this->getTableName();

        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return Db::getInstance()->queryOneObj($sql, ['id' => $id], $this->getEntityClass());
    }

// INSERT -----------------------

    public function insert(Model $entity) {
            $params = [];
            $columns = [];
            $values = "";

        foreach ($entity->props as $key => $value) { // Добавили после $this ->props,
                                                  // иначе не будет доступа к приватным полям
            //if ($key == 'id') continue; //УСЛОВИЕ при props вообще не нужно
           //$params[":{$key}"] = $value; //ВМЕСТО $value - строка ниже, нужное имя поля по ключу

//            var_dump($this);
//            var_dump($key);

            $params[":{$key}"] = $entity->$key; // ":{$key}"] это получится :имя_ключа;
            // $this->$key  это обращение к значению поля по ключу, который равен ключу в пропсах

            //$params[":" . $key] = $this->$key;
            $columns[] = "$key";
        }

        $columns = implode(", ", $columns); // Сделать из массива строку с запятой

        $values = implode(", ", array_keys($params)); // Сделать из ключей в массиве строку
        // Результат ':name, :category_id, :price, :description'

        $tableName = $this->getTableName(); //// ??????

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values});";
        Db::getInstance()->execute($sql, $params);

        $entity->id = Db::getInstance()->lastInsertId();
    }

// DELETE -----------------------

    public function delete(Model $entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id;";

        return Db::getInstance()->execute($sql, [':id' => $entity->id]);
    }

// UPDATE -----------------------
    public function update(Model $entity) {
        $params = [];
        $columns = [];
        foreach ($entity->props as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $entity->$key;
            $columns[] .= "`{$key}` = :{$key}";
            $entity->props[$key] = false;
        }

        $columns = implode(", ", $columns);
        $params['id'] = $entity->id;
//        var_dump($params);
//        var_dump($columns);
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET {$columns} WHERE `id` = :id";

        Db::getInstance()->execute($sql, $params);
    }

// НАЙТИ ПО ОПРЕДЕЛЕННОМУ полю = имени столбца в БД -----------------------------------------------------

    public function getWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field}` = :value";

        return Db::getInstance()->queryOneObj($sql, ['value' => $value], $this->getEntityClass());
    }

    // НАЙТИ ПО ОПРЕДЕЛЕННОМУ полю = имени столбца в БД  еще полю = имени-----------------------------------------------------

    public function getWhereAnd($field1, $field2, $value1, $value2) {
        $tableName = $this->getTableName();
//        var_dump($value2);
//        die();

        $sql = "SELECT * FROM {$tableName} WHERE `{$field1}` = :value1 AND `{$field2}` = :value2";

        return Db::getInstance()->queryOneObj($sql, ['value1' => $value1, 'value2' => $value2,], $this->getEntityClass());
    }

// Посчитать сумму по определенному полю в БД -----------------------------------------------------

    public function getCountWhere($counted, $field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT SUM({$counted}) AS count FROM {$tableName} WHERE `{$field}` = :value;";

        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }

// НАЙТИ КАТЕГОРИЮ -----------------------------------------------------

    public function getCategorie($category_id)
    {
        $tableName = 'categories';
        $sql = "SELECT `name` FROM {$tableName} WHERE `id` = :id";

        return Db::getInstance()->queryOne($sql, ['id' => $category_id]);
    }



    abstract protected function getEntityClass();
    abstract protected function getTableName(); // абстрактный метод не соджержит тела, а только название ф-ции
    //СЛЕДИТ за тем, чтобы метод был определен в классе-наследнике

}