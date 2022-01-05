<?php
//define('ROOT_DIR', dirname(__DIR__));
//define('DS', DIRECTORY_SEPARATOR); //  это будет /
//define('CONTROLLERS_NAMESPACE', "app\\controllers\\" );
//define('PRODUCT_PER_PAGE', 4); // это константа для страницы каталога,
//сколько товаров выводится за один раз на страницу

//константы для формирования абсолютного пути до файлов
//в мампе не работают - работают верно, но в мампе без указания точки входа хочет http://localhost:8888/public/index.php
//В мампе можно настроить, куда ему смотреть, где у него точка входа, и тогда DS будет работать



use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\model\repositories\CartRepo;
use app\model\repositories\ProductRepo;
use app\model\repositories\UserRepo;
use app\model\repositories\OrderRepo;

return [
    'root_dir' =>  dirname(__DIR__),
    'controllers_namespace' => 'app\\controllers\\',
    'product_per_page' => 4,
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:8889',
            'login' => 'root',
            'password' => 'root',
            'database' => 'brand_shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'cartRepo' => [
            'class' => CartRepo::class
        ],
        'productRepo' => [
            'class' => ProductRepo::class
        ],
        'userRepo' => [
            'class' => UserRepo::class
        ],
        'orderRepo' => [
            'class' => OrderRepo::class
        ],
        'session' => [
            'class' => Session::class
        ]
    ]
];

