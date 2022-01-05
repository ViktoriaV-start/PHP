<?php

namespace app\model;
use app\engine\Db;

class User extends DbModel //интерфейсов может быть много, через запятую
{
    protected $id;
    protected $login;
    protected $name;
    protected $surname;
    protected $email;
    protected $phone;
    protected $pass;
    protected $hash;


    // ЭТО набор данных, чтобы иметь доступ к protected переменным при методе UPDATE,
// чтобы проверить, какие поля изменились
    protected $props = [
        'login' => false, // это означает, что поле не изменилось
        'name' => false,
        'surname' => false,
        'email' => false,
        'phone' => false,
        'pass' => false
    ];

    public function __construct($login = null, $name = null, $surname = null, $email = null, $phone = null, $pass = null)
    {
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->pass = $pass;
    }

    public static function getTableName() {
        return 'users';
    }
    public function findLogin($login) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE login = :login";

        return Db::getInstance()->queryOneObj($sql, ['login' => $login], static::class);
    }

}