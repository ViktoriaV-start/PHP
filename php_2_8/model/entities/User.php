<?php

namespace app\model\entities;
use app\engine\Db;
use app\model\Model;

class User extends Model //интерфейсов может быть много, через запятую
{
    protected $id;
    protected $login;
    protected $name;
    protected $surname;
    protected $email;
    protected $phone;
    protected $pass;
    protected $hash;
    protected $address;


    // ЭТО набор данных, чтобы иметь доступ к protected переменным при методе UPDATE,
// чтобы проверить, какие поля изменились
    protected $props = [
        'login' => false, // это означает, что поле не изменилось
        'name' => false,
        'surname' => false,
        'email' => false,
        'phone' => false,
        'address' => false,
        'pass' => false,
        'hash' => false
    ];

    public function __construct($login = null, $name = null, $surname = null, $email = null, $phone = null, $address = null, $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->pass = $pass;
        $this->hash = $hash;
    }


//    public function findLogin($login) {
//        $tableName = static::getTableName();
//        $sql = "SELECT * FROM {$tableName} WHERE login = :login";
//
//        return Db::getInstance()->queryOneObj($sql, ['login' => $login], static::class);
//    }









}