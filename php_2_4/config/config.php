<?php
define('ROOT_DIR', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR); //  это будет /
define('CONTROLLERS_NAMESPACE', "app\\controllers\\" );

//константы для формирования абсолютного пути до файлов
//в мампе не работают - работают верно, но в мампе без указания точки входа хочет http://localhost:8888/public/index.php
//В мампе можно настроить, куда ему смотреть, где у него точка входа, и тогда DS будет работать