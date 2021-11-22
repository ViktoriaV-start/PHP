<?php

namespace app\controllers;
use app\model\Cart;
use app\engine\Render;

class CartController extends Controller
{
    public $session_id;

    public function actionIndex() { // в названии используем Index - чтобы по умолчанию
        // строилось имя метода actionIndex в экземпляре класса Cart
        //echo $this->render('index');

        $goods = Cart::getCart(111);

        return $this->rend->renderCart($goods);
    }
}