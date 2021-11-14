<?php
use Twig\Environment; //namespace самого twig
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php'; // ПОДКЛЮЧЕНИЕ twig

$loader = new FilesystemLoader('../templates');

$twig = new Environment($loader, [
   'cache' => '../cache', // сюда складываются компилированные шаблоны
]);
//$twig = new Environment($loader, [
//    БЕЗ КЭШИРОВАНИЯ
//]);
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

$images = array_splice(scandir("images/img_big"), 2);

if (($_GET['action'] == 'home')) {
    echo $twig->render('index.twig', [
        'navigation' => $navigation,
        'images' => $images
    ]);
    header('Location: /');
    die();
}

if (isset($_GET['name'])) {
    $img_name = $_GET['name'];

    echo $twig->render('open_img.twig', [
        'navigation' => $navigation,
        'img_name' => $img_name
    ]);
    die();
}

try {
    echo $twig->render('index.twig', [ // синтаксис для рендера страницы
        'navigation' => $navigation,
        'images' => $images
        // это передача параметров/переменных, которые используем в шаблоне, который
        // находится в index.twig. То есть в коде выше рендера есть переменные -$navigation, $images,
        // а здесь их передаем внутрь index.twig.
        //Внимание! если внутри шаблона подключается еще шаблон (навигация, футер),
        //здесь также нужно передать параметры и для них, иначе не сработает.
    ]);
}
catch (Exception $exception) {
    var_dump($exception);
    die();
}
