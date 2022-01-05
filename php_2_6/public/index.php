<?php
session_start();
include "../config/config.php";
include "../engine/Autoload.php";
use app\model\Product;
use app\model\User;
use app\model\Model;
use app\model\Cart;
use app\model\Order;
use app\controllers\Controller;
use app\engine\Request;

spl_autoload_register([new Autoload(), 'loadClass']);
$request = new Request();

//Формируем имя контроллера по инфо из адресной строки и имя метода в контроллере

$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";
//var_dump($controllerClass); // 'app\controllers\ProductController'

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();  // cоздать экземпляр класса контроллера
    $controller->runAction($actionName); // здесь получим имя метода в этом конкретном контроллере
}

