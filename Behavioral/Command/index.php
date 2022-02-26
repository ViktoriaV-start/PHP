<?php
spl_autoload_register(function($class) {
   include $class . '.php';
});

$text = "Команда инкапсулирует запрос как объект, позволяя задавать параметры клиентов 
для обработки соответствующих запросов, протоколировать или ставить их в очередь, 
а также поддерживать отмену операций. Получаем механизм логирования операций и возможность отката.";

echo $text;

$test = new Controller($text);
echo $test->action("copy", 0,10);
echo $test->action("cut", 0,3);
echo $test->action("cut", 0,5);
echo $test->action("paste", 0,0, ' BRAVO-BRAVO ');
echo $test->action("paste", 0,0, ' BRAVO-BRAVO ');
$test->rollBack(5);

$test->repeat(5);

