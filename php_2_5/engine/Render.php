<?php

namespace app\engine;
use Twig\Environment; //namespace самого twig
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php'; // ПОДКЛЮЧЕНИЕ twig



class Render
{

    private static $twig = null;
    private static $loader = null;
    public $navigation = [
[
'href' => '/product',
'caption' => 'HOME',
],
[
'href' => '/cart',
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


    public function __construct()
    {
        static::$loader = new FilesystemLoader('../templates');
    }


    public static function getTwig() {
        if (is_null(static::$twig)) {
//            $loader = new FilesystemLoader('../templates');
            static::$twig = new Environment(static::$loader, [
            ]);

        }
        return static::$twig;
    }

    public function renderCatalog($goods, $page=null)
    {
        static::getTwig();

        echo static::$twig->render('index.twig', [ // синтаксис для рендера страницы
            'navigation' => $this->navigation,
            'goods' => $goods,
            'page' => ++$page,
            'userName' => $_SESSION['name']
            // это передача параметров/переменных, которые используем в шаблоне, который
            // находится в index.twig. То есть в коде выше рендера есть переменные -$navigation, $images,
            // а здесь их передаем внутрь index.twig.
            //Внимание! если внутри шаблона подключается еще шаблон (навигация, футер),
            //здесь также нужно передать параметры и для них, иначе не сработает.
        ]);
    }


    public function renderCart($goods)
    {
        static::getTwig();

        echo static::$twig->render('cart.twig', [ // синтаксис для рендера страницы
            'navigation' => $this->navigation,
            'goods' => $goods,
            'userName' => $_SESSION['name']
        ]);
    }

    public function renderAuth($message= "222")
    {
        static::getTwig();

        echo static::$twig->render('auth.twig', [ // синтаксис для рендера страницы
            'navigation' => $this->navigation,
            'message' => $message
        ]);
    }

    public function renderUser($message = "222")
    {
        static::getTwig();

        echo static::$twig->render('user.twig', [ // синтаксис для рендера страницы
            'navigation' => $this->navigation,
            'message' => $message,
            'userName' => $_SESSION['name']
        ]);
    }

}