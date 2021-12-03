<?php

namespace app\controllers;

use app\engine\Db;
use app\engine\Request;
use app\model\entities\Cart;
use app\model\entities\Order;
use app\engine\Render;
use app\model\repositories\CartRepo;
use app\model\repositories\OrderRepo;
use app\engine\App;
use app\engine\Session;

class CartController extends Controller
{
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

        $productCart = (new CartRepo())->getWhereAnd('session_id','product_id', $session_id, $productId);

        $product = new Cart();
        $product->id = $productCart->id;
        $product->session_id = $productCart->session_id;
        $product->product_id = $productCart->product_id;
        $product->quantity = $productCart->quantity;
        $product->price = $productCart->price;
        $product->subtotal = $productCart->subtotal;

        $cartRepo = App::call()->cartRepo; // ПОТОМ СДЕЛАТЬ ЗАМЕНУ
        //var_dump(App::call()->cartRepo);


        if ($productCart) {

            $product->quantity = $product->quantity + 1;
            $product->subtotal = $product->quantity * $product->price;

            $cartRepo->update($product);


        } else {

            $product = (new Cart($session_id, $productId));

            App::call()->cartRepo->insert($product);
            App::call()->cartRepo->fixAndCalc($session_id, $productId);

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

    public function actionOrdering() {

        $goods = (new CartRepo())->getCart();
        $userId = App::call()->session->getSession('id');

        if ($userId) {
            $user = App::call()->userRepo->getOne($userId);
            if (App::call()->cartRepo->getCart()) {
                return $this->rend->renderOrdering($goods, $user);
            } else {
                header('Location: /product'); // перенаправить на страницу входа
                die();
            }

        } else {
            header('Location: /auth'); // перенаправить на страницу входа
            die();
        }

    }

        public function actionPlacement() {
        $userId = (new Request())->getParams()['id'];
        $session_id = session_id();

        $order = new Order($session_id, $userId,);



        $id = App::call()->orderRepo->insert($order);
        App::call()->db->execute("UPDATE orders SET created_at = NOW() WHERE id = {$id};");


        App::call()->db->execute("CALL add_order_id();");

        $response = [
                'success' => 'ok',
            'orderNumber' => $id

        ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        session_destroy();

    }


}