<?php
namespace app\model\repositories;

use app\engine\App;
use app\model\Repository;
use app\model\entities\Cart;
use app\model\entities\Order;

class OrderRepo extends Repository
{

    public function getTableName() {
        return 'orders';
    }
    public function getSessionId() {
        return session_id();
    }

    public function getOrder()
    {
        $session_id = 111;
        $tableName = getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE session_id = :session_id";
        var_dump($sql);
        var_dump(App::call()->db->queryOneObj($sql, ['session_id' => $session_id]));
        die();


        return App::call()->db->queryOneObj($sql, ['session_id' => $session_id]);
    }


    protected function getEntityClass()
    {
        return Order::class;
    }
}