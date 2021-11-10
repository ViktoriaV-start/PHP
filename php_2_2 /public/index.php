<?php
include "../engine/Autoload.php";
include "../config/config.php";


use app\model\Piece; //as Piece; - создание псевдонима
use app\model\Weighed;
use app\model\Digital;


spl_autoload_register([new Autoload(), 'loadClass']);

//$piece = new app\model\Piece(); //разраб/вирт.папка=папка где лежит/Имя класса
$piece = new Piece('Книга', 2,  280);  // создать экземпляр класса Db и передать в конструктор класс
// Piece в качестве параметра, который создается.
echo $piece->name . ' - общая стоимость за ' . $piece->quantity . 'шт. ' . $piece->getTotal() . 'руб';
var_dump($piece);
echo $piece->getAll() . PHP_EOL; // Команда на извлечение всех записей из соответствующей таблице в БД

$weighed = new Weighed('Яблоко', 120,  3.5);
echo $weighed->name . ' - общая стоимость за ' . $weighed->quantity . 'кг ' . $weighed->getTotal() . 'руб';
var_dump($weighed);
echo $weighed->getOne(5) . PHP_EOL;

$digit = new Digital('Цифровая книга', 1);
$digit->getDigitPrice($piece->price);
echo $digit->name . ' - общая стоимость за ' . $digit->quantity . 'шт ' . $digit->getTotal() . 'руб';
var_dump($digit);
echo $weighed->delete() . PHP_EOL;

