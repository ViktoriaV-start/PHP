<?php
namespace app\controllers;
use app\model\Product;
use app\engine\Render;

class ProductController extends Controller
{
    public function actionIndex() {
        //echo $this->render('index');

        $page = $_GET['page'] ?? 0;
        $goods = Product::getLimit(($page + 1) * PRODUCT_PER_PAGE);

        return $this->rend->renderCatalog($goods, $page);
        // Обратились к сохраненному экземпляру класса Render и внем вызываем метод renderCatalog
    }

    public function actionCatalog() {

        $page = $_GET['page'] ?? 0;

        //$catalog = Product::getLimit($page); //TODO умножить page на количество товаров на страницу
        $catalog = Product::getLimit(($page + 1) * PRODUCT_PER_PAGE);

        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard() {

        $id = (int)$_GET['id'];

        $good = Product::getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }
}