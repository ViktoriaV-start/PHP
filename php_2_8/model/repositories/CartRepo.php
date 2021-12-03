<?php
namespace app\model\repositories;

use app\engine\App;
use app\engine\Db;
use app\model\Repository;
use app\model\entities\Cart;

class CartRepo extends Repository
{
    public function getTableName() {
        return 'carts';
    }
    public function getSessionId() {
        return session_id();
    }
    public function getCart()
    {
        $session_id = session_id();
        $tableName = 'order_info';
        $sql = "SELECT * FROM {$tableName} WHERE session_id = :session_id;";
        return App::call()->db->queryAll($sql, ['session_id' => $session_id]);
    }

    public function fixAndCalc($session_id, $productId) {

        App::call()->db->execute("CALL fix_price();");

        $productCart = $this->getWhereAnd('session_id', 'product_id', $session_id, $productId);

        $product = new Cart();

        $product->id = $productCart->id;
        $product->session_id = $productCart->session_id;
        $product->product_id = $productCart->product_id;
        $product->quantity = $productCart->quantity;
        $product->price = $productCart->price;
        $product->subtotal = $productCart->subtotal;

        $product->subtotal = $product->price * $product->quantity;
        $product->props['subtotal'] = true;
        $this->update($product);

    }

    public function deleteAll() {
        $session_id = session_id();
        $tableName = 'carts';
        $sql = "DELETE FROM {$tableName} WHERE session_id = :session_id;";
        App::call()->db->execute($sql, ['session_id' => $session_id]);
    }

    public function getCountWhere($counted, $field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT SUM({$counted}) AS count FROM {$tableName} WHERE `{$field}` = :value AND order_id IS NULL;";

        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

    protected function getEntityClass()
    {
        return Cart::class;
    }
}