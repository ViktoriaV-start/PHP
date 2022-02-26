<?php

// ЗАДАНИЕ 1: Написать аналог «Проводника» в Windows для директорий на сервере при помощи итераторов.



// ВОПРОС:::::::::    КАК вывести пробел n раз? Получаю число n - это количество элементов в массиве,
// но не могу повторить строку с пробелом, str_repeat повторяет только текст.

$path = $_SERVER['DOCUMENT_ROOT'];
var_dump($path);


$splObjects = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($path),
    RecursiveIteratorIterator::SELF_FIRST,
    false
);

foreach ($splObjects as $name => $obj) {

    if ($obj->getFileName() === '.' || $obj->getFileName() === '..') continue;

    $getPath = str_replace($path . '/', "", $obj->getFileInfo());

    $pathArr = explode('/', $getPath);

    $length = count($pathArr);

    if ($length === 1) echo "<br><br>";
    if ($length === 1 && $obj->isDir()) echo "ПРОЕКТ";

    echo str_repeat(":  ", $length) . $obj->getFileName();
    echo "<br>";
}


// ЗАДАНИЕ 2: Определить сложность следующих алгоритмов:
// -- поиск элемента массива с известным индексом - O(n)
// -- дублирование массива через foreach - O(n)
// -- рекурсивная функция нахождения факториала числа - O(n)

$arr = [1,2,3];
$new = [];
foreach ($arr as $el) {
    $new[] = $el;
}

// -----------------------------------------------------------------

$n = 7;

function fact($n) {
    if ($n === 0) {
        return 1;
    }
$res = $n * fact($n-1);
        return $res;
}

echo fact($n);

// -----------------------------------------------------------------

// ЗАДАНИЕ 3: Определить сложность следующих алгоритмов. Сколько произойдет итераций?

// 2306 ИТЕРАЦИЙ, сложность O(n * log(n)),


//$n = 100;
//$array[]= [];
//$count = 6;
//for ($i = 0; $i < $n; $i++) {
//    $count = $count + 2;
//    for ($j = 1; $j < $n; $j *= 2) {
//
//        $array[$i][$j]= true;
//        $count = $count + 3;
//    }
//}
//
//var_dump($count);

// -----------------------------------------------------------------

// 7756 ИТЕРАЦИЙ, сложность O(n^2)

$n = 100;
$array[] = [];
$count = 6;
for ($i = 0; $i < $n; $i += 2) {
    $count = $count + 2;
for ($j = $i; $j < $n; $j++) {
    $count = $count + 3;
$array[$i][$j]= true;
} }
var_dump($count);


//ЗАДАНИЕ 4: Каков самый большой делитель числа 600851475143, являющийся простым числом?
// 6857 является наибольшим простым делителем числа 600851475143

$num = 600851475143;

//КРОМЕ 1, 2
function checkPrime($num) {
    $h = floor($num/2);
    for ($i=2; $i <= $h; $i++) {

        if ($num % $i === 0) {
            return $i;
        }
    }
    return "Простое";
}

function findMaxPrimeDivisor($num) {
    if (checkPrime($num) === "Простое") {
        return $num;
    }
    $half = floor($num/2);

    for ($i=2; $i <= $half; $i++) {
        if ($num % $i === 0) {
            $cur = $num / $i;
            if (checkPrime($cur) === "Простое") {
                return $cur;
            }
        }
    }
}

echo findMaxPrimeDivisor($num) . ' является наибольшим простым делителем числа ' . $num;

