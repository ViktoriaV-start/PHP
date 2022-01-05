<?php

namespace app\engine;

use app\traits\TSingltone;

class Db
{
    use TSingltone;

    protected function getConnection() {

    }

    public function queryOne($sql){
        $this->getConnection();
        return $sql;
    }
    public function queryAll($sql){
        $this->getConnection();
        return $sql;
    }
    public function execute($sql){
        $this->getConnection();
        echo "Удалено";

    }

    public function insert($sql){
        $this->getConnection();
        echo "Вставка";

    }

}