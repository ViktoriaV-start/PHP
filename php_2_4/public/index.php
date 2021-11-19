<?php
include "../config/config.php";
include "../engine/Autoload.php";
use Twig\Environment; //namespace самого twig
use Twig\Loader\FilesystemLoader;
use app\model\Product;
use app\model\User;
use app\model\Cart;
use app\model\Order;
use app\controllers\Controller;

spl_autoload_register([new Autoload(), 'loadClass']);

require_once '../vendor/autoload.php'; // ПОДКЛЮЧЕНИЕ twig

$loader = new FilesystemLoader('../templates');

//$twig = new Environment($loader, [
//   'cache' => '../cache', // сюда складываются компилированные шаблоны
//]);
$twig = new Environment($loader, [

]);
$navigation = [
    [
        'href' => '#',
        'caption' => 'HOME',
    ],
    [
        'href' => '#',
        'caption' => 'MEN',
    ],
    [
        'href' => '#',
        'caption' => 'WOMEN',
    ],
    [
        'href' => '#',
        'caption' => 'KIDS',
    ],
    [
        'href' => '#',
        'caption' => 'ACCESORIES',
    ],
    [
        'href' => '#',
        'caption' => 'FEATURED',
    ],
        [
            'href' => '#',
            'caption' => 'HOT DEALS',
        ]
];

$goods = Product::getAll();

//if (($_GET['action'] == 'home')) {
//    echo $twig->render('index.twig', [
//        'navigation' => $navigation,
//        'goods' => $goods
//    ]);
//    header('Location: /');
//    die();
//}

//if (isset($_GET['name'])) {
//    $img_name = $_GET['name'];
//
//    echo $twig->render('open_img.twig', [
//        'navigation' => $navigation,
//        'img_name' => $img_name
//    ]);
//    die();
//}


$controller = new Controller();
$controller->render($twig, $navigation, $goods);





