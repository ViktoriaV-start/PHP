<?php

namespace app\model;
use app\engine\Db;
class Cart extends DbModel
{
    protected $session_id;
    protected $order_id;
    protected $product_id;
    protected $quantity;
    protected $price;
    protected $subtotal;

    protected $props = [
        'session_id' => false, // это означает, что поле не изменилось
        'order_id' => false,
        'product_id' => false,
        'quantity' => false,
        'price' => false,
        'subtotal' => false

    ];

    public function __construct($session_id = null,  $product_id = null, $quantity = 1, $order_id = null)
    {
        $this->session_id = $session_id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    public static function getTableName() {
        return 'carts';
    }
    public function insert() {
        $tableName = 'carts';
        $sql = "INSERT INTO {$tableName} (session_id, product_id, quantity) 
                 VALUE ('$this->session_id', $this->product_id, $this->quantity);";
        Db::getInstance()->execute($sql);
        Db::getInstance()->execute("CALL fix_price();");
        Db::getInstance()->execute("CALL calc_subtotal();");
    }

    public function getCart($session_id)
    {
        $tableName = 'order_info';
        $sql = "SELECT * FROM {$tableName} WHERE session_id = :session_id";
        return Db::getInstance()->queryAll($sql, ['session_id' => $session_id]);
    }

    public function delete($session_id) {
        $tableName = 'carts';
        $sql = "DELETE FROM {$tableName} WHERE session_id = :session_id;";
        var_dump($sql);
        Db::getInstance()->execute($sql, ['session_id' => $session_id]);
    }

}