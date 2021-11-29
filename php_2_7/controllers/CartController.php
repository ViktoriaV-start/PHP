<?php

namespace app\controllers;
use app\engine\Db;
use app\engine\Request;
use app\model\entities\Cart;
use app\engine\Render;
use app\model\repositories\CartRepo;

//use function mysql_xdevapi\getSession;

class CartController extends Controller
{
    //public $session_id;

    public function actionIndex() { // в названии используем Index - чтобы по умолчанию
        // строилось имя метода actionIndex в экземпляре класса Cart
        //echo $this->render('index');

        $goods = (new CartRepo())->getCart();

        return $this->rend->renderCart($goods);
    }

    public function actionAdd() {

        //$data = json_decode(file_get_contents("php://input"));


        $productId = (new Request())->getParams()['id'];
        $session_id = session_id();


//        $basket = new Basket(session_id(), $id);
//
//        (new BasketRepository())->save($basket);

       // $productCart = new Cart(session_id(), $productId);

        $productCart = (new CartRepo())->getWhereAnd('session_id','product_id', $session_id, $productId);

        $product = new Cart();
        $product->id = $productCart->id;
        $product->session_id = $productCart->session_id;
        $product->product_id = $productCart->product_id;
        $product->quantity = $productCart->quantity;
        $product->price = $productCart->price;
        $product->subtotal = $productCart->subtotal;

        $cartRepo = new CartRepo(); // ПОТОМ СДЕЛАТЬ ЗАМЕНУ


        if ($productCart) {

            $product->quantity = $product->quantity + 1;
            $product->subtotal = $product->quantity * $product->price;

            $cartRepo->update($product);


        } else {

            $product = (new Cart($session_id, $productId));
            $cartRepo->insert($product);
            $cartRepo->fixAndCalc($session_id, $productId);

        }
        $count = $cartRepo->getCountWhere('quantity', 'session_id', session_id());
        $sum = $cartRepo->getCountWhere('quantity','session_id', session_id());

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
        $session_id = session_id();

        $productCart = (new CartRepo())->getWhereAnd('session_id','id', $session_id, $id);

        $product = new Cart();
        $product->id = $productCart->id;
        $product->session_id = $productCart->session_id;
        $product->product_id = $productCart->product_id;
        $product->quantity = $productCart->quantity;
        $product->price = $productCart->price;
        $product->subtotal = $productCart->subtotal;

        $cartRepo = new CartRepo(); // ВНИМАНИЕ - ЭТОТ КУСОК БУДЕТ СОЗДАВАТЬСЯ ОТДЕЛЬНО И ДАЛЕЕ В КОДЕ НАДО БУДЕТ ПОМЕНЯТЬ


        if ($product->quantity > 1) {
            $product->quantity = $product->quantity - 1;
            //$product->update();
            $product->subtotal = $product->quantity * $product->price;
            $cartRepo->update($product);

            $count = $cartRepo->getCountWhere('quantity', 'session_id', session_id());
            $sum = $cartRepo->getCountWhere('subtotal','session_id', session_id());

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

            $cartRepo->delete($product);
            $count = $cartRepo->getCountWhere('quantity', 'session_id', session_id());
            $sum = $cartRepo->getCountWhere('subtotal','session_id', session_id());
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
        (new CartRepo())->deleteAll();
        header('Location: /product'); // перенаправить на страницу входа
        die();
    }

}