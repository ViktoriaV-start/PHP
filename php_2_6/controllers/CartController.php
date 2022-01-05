<?php

namespace app\controllers;
use app\engine\Db;
use app\engine\Request;
use app\model\Cart;
use app\engine\Render;
//use function mysql_xdevapi\getSession;

class CartController extends Controller
{
    //public $session_id;

    public function actionIndex() { // в названии используем Index - чтобы по умолчанию
        // строилось имя метода actionIndex в экземпляре класса Cart
        //echo $this->render('index');

        $goods = Cart::getCart();

        return $this->rend->renderCart($goods);
    }

    public function actionAdd() {

        //$data = json_decode(file_get_contents("php://input"));

        $productId = (new Request())->getParams()['id'];
        $product = Cart::getWhereAnd('session_id','product_id', session_id(), $productId);


        if ($product) {
           $product->quantity = $product->quantity + 1;
           $product->update();
           $product->subtotal = $product->quantity * $product->price;
           $product->update();



        } else {
            $product = (new Cart(session_id(), $productId))->insert();
            $product->fixAndCalc();


        }
        $count = Cart::getCountWhere('quantity', 'session_id', session_id());
        $sum = Cart::getCountWhere('quantity','session_id', session_id());

        $response = [
          'success' => 'ok',
            'count' => $count,
            'sum' => $sum
        ];


        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function actionDelete() {

        //$data = json_decode(file_get_contents("php://input"));

        $id = (new Request())->getParams()['id'];
        $product = Cart::getWhere('id', $id);

        if ($product->quantity > 1) {
            $product->quantity = $product->quantity - 1;
            $product->update();
            $product->subtotal = $product->quantity * $product->price;
            $product->update();

            $count = Cart::getCountWhere('quantity', 'session_id', session_id());
            $sum = Cart::getCountWhere('subtotal','session_id', session_id());

            $response = [
                        'success' => 'ok',
                             'id' => $id,
                          'count' => $count,
                'productQuantity' => $product->quantity,
                'productSubtotal' => $product->subtotal,
                            'sum' => $sum
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


        } else {
            Cart::delete($id);
            $count = Cart::getCountWhere('quantity', 'session_id', session_id());
            $sum = Cart::getCountWhere('subtotal','session_id', session_id());
            $response = [
                        'success' => 'ok',
                             'id' => $id,
                          'count' => $count,
                'productQuantity' => 0,
                'productSubtotal' => 0,
                'sum' => $sum
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        }
    }

    public function actionClear() {
        Cart::deleteAll();
        header('Location: /product'); // перенаправить на страницу входа
        die();
    }

}