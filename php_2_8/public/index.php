<?php
session_start();

//include "../config/config.php";

require_once "../vendor/autoload.php"; // А ВОТ ЭТУ СТРОКУ НУЖНО НАПИСАТЬ, ЧТОБЫ СРАБАТЫВАЛ АВТОЗАГРУЗЧИК
//include "../engine/Autoload.php"; // КОГДА НАСТРОИЛИ АВТОЗАГРУЗЧИК
// в composer.json для тестировки, тогда можно отключить этот автозагрузчик

//use app\model\entities\Product;
//use app\model\entities\User;
//use app\model\Model;
//use app\model\entities\Cart;
//use app\model\entities\Order;
//use app\controllers\Controller;
//use app\engine\Request;

use app\engine\App;

//spl_autoload_register([new Autoload(), 'loadClass']); // КОГДА НАСТРОИЛИ АВТОЗАГРУЗЧИК
// в composer.json для тестировки, тогда можно отключить этот автозагрузчик



$config = include "../config/config.php";


try {

    App::call()->run($config);




   // $request = new Request();

//Формируем имя контроллера по инфо из адресной строки и имя метода в контроллере

//    $controllerName = $request->getControllerName() ?: 'product';
//    $actionName = $request->getActionName();
//
//    $controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";
////var_dump($controllerClass); // 'app\controllers\ProductController'
//
//    if (class_exists($controllerClass)) {
//        $controller = new $controllerClass();  // cоздать экземпляр класса контроллера
//        $controller->runAction($actionName); // здесь получим имя метода в этом конкретном контроллере
//    }

}
catch (\PDOException $e) {
    var_dump($e);
} catch (\Exception $e) {
    var_dump($e->getTrace());
}