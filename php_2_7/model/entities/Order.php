<?php

namespace app\model\entities;

use app\engine\Db;
use app\model\Model;

class Order extends Model
{
    public $id;
    public $session_id;
    public $user_id;
    public $created_at;
    public $updated_at;
    public $finished_at;

    public function __construct($session_id = null, $user_id = null)
    {
        $this->session_id = $session_id;
        $this->user_id = $user_id;
    }

    public static function getTableName() {
        return 'orders';
    }

//    public function insert() {
//        $tableName = $this->getTableName();
//        $sql = "INSERT INTO {$tableName} (session_id, user_id)
//                 VALUE ('$this->session_id',
//                         $this->user_id);";
//        Db::getInstance()->execute($sql);
//    }
}
