<?php
define('ROOT_DIR', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);

//константы для формирования абсолютного пути до файлов
//в мампе не работают - работают верно, но в мампе хочет http://localhost:8888/public/index.php
//здесь можно настроить, куда ему смотреть, где у него точка входа