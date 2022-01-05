<?php

namespace app\model;

use app\interfaces\IModel;
use app\engine\Db;

abstract class Model implements IModel// абстрактный класс общий функционал для всех наследников
{


// Два магических метода: когда поля в классе сделаны приватными и
// в этом случае используем эти методы.
    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }

}