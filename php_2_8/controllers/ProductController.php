<?php
namespace app\controllers;

use app\model\repositories\ProductRepo;
use app\engine\App;

class ProductController extends Controller
{
    public function actionIndex() {

          $page = $_GET['page'] ?? 0;

        $goods = (new ProductRepo())->getLimit(($page + 1) * App::call()->config['product_per_page']);


        return $this->rend->renderCatalog($goods, $page);
        // Обратились к сохраненному экземпляру класса Render и внем вызываем метод renderCatalog
    }

    public function actionCard() {

        $id = (int)$_GET['id'];

        $product = (new ProductRepo())->getOne($id);

        $category = (new ProductRepo())->getCategorie($product->category_id);

        return $this->rend->renderCard($product, $category);
    }
}