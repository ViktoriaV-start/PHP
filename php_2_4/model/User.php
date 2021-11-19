<?php

namespace app\model;
use app\engine\Db;

class User extends DbModel //интерфейсов может быть много, через запятую
{
    public $id;
    public $login;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $pass;
    public $hash;

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

}