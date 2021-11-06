<!--1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения.
Затем написать скрипт, который работает по следующему принципу:-->
<!--если $a и $b положительные, вывести их разность;-->
<!--если $а и $b отрицательные, вывести их произведение;-->
<!--если $а и $b разных знаков, вывести их сумму;-->
<!--Ноль можно считать положительным числом.-->
<?php
$x = rand(-10, 10);
$y = rand(-10, 10);
echo "I задание: ";
if ($x >= 0 && $y >= 0) {
    if ($x > $y) {
        $c = $x - $y;
        echo "Разность чисел $x и $y составляет $c";
    } else {
        $c = $y - $x;
        echo "Разность чисел $y и $x составляет $c";
    }
}

if ($x < 0 && $y < 0) {
        $c = $x * $y;
        echo "Произведение чисел $y и $x составляет $c ";
}

if ($x < 0 && $y > 0) {
    $c = $x + $y;
    echo "Сумма чисел $y и $x составляет $c";
}

if ($x > 0 && $y < 0) {
    $c = $x + $y;
    echo "Сумма чисел $y и $x составляет $c";
}
?>
<br><br>
<!--2. Присвоить переменной $а значение в промежутке [0..15].-->
<!--С помощью оператора switch организовать вывод чисел от $a до 15.-->
<?php
$z = rand (0, 15);
echo "II задание:"
?>
<br>
<?php
switch ($z) {
    case 0:
        show($z);
        break;
    case 1:
        show($z);
        break;
    case 2:
        show($z);
        break;
    case 3:
        show($z);
        break;
    case 4:
        show($z);
        break;
    case 5:
        show($z);
        break;
    case 6:
        show($z);
        break;
    case 7:
        show($z);
        break;
    case 8:
        show($z);
        break;
    case 9:
        show($z);
        break;
    case 10:
        show($z);
        break;
    case 11:
        show($z);;
        break;
    case 12:
        show($z);
        break;
    case 13:
        show($z);
        break;
    case 14:
        show($z);
        break;
    case 15:
        echo 15;
        break;
}

function show($a) {
    for ($i = $a; $i <= 15; $i++) {
        echo $i; ?><br><?php
    }
}
?>
<br>

<!--3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. -->
<!--Обязательно использовать оператор return.-->

III задание:
<?php
function sum($x, $y) {
    return $x + $y;
}
function dif($x, $y) {
    return $x - $y;
}
function mult($x, $y) {
    return $x * $y;
}
function division($x, $y) {
    if ($y == 0) {
        return "ОШИБКА: нельзя делить на ноль";
    } else {
        return round(($x / $y), 2);
    }
}
echo "Сумма чисел $x и $y равна " . sum($x, $y);
?>
<br>
<?php
echo "Разность чисел $x и $y равна " . dif($x, $y);
?>
<br>
<?php
echo "Произведение чисел $x и $y равно " . mult($x, $y);
?>
<br>
<?php
echo "Частное от деления числа $x на число $y равно " . division($x, $y);
?>
<br><br>
IV задание:
<br>

<!--4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), -->
<!--где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. -->
<!--В зависимости от переданного значения операции выполнить одну из арифметических операций -->
<!--(использовать функции из пункта 3) и вернуть полученное значение (использовать switch).-->

<?php
function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case "+":
            echo sum($arg1, $arg2);
            break;
        case "-":
            echo dif($arg1, $arg2);
            break;
        case "*":
            echo mult($arg1, $arg2);
            break;
        case "/":
            echo division($arg1, $arg2);
            break;
    }
}

$arg1 = 2;
$arg2 = 5;
echo "Сумма чисел $arg1 и $arg2 равна ";
mathOperation($arg1, $arg2, "+");
?>
<br>
<?php
echo "Разность чисел $arg1 и $arg2 равна ";
mathOperation($arg1, $arg2, "-");
?>
<br>
<?php
echo "Произведение чисел $arg1 и $arg2 равно ";
mathOperation($arg1, $arg2, "*");
?>
<br>
<?php
echo "Частное от деления чисел $arg1 и $arg2 равно ";
mathOperation($arg1, $arg2, "/");
?>

<br><br>
<?php
//6. *С помощью рекурсии организовать функцию возведения числа в степень.
//Формат: function power($val, $pow), где $val – заданное число, $pow – степень.

function power($val, $pow) {
    if ($pow != 1) {
        return $val * power($val, $pow - 1);
    }
    return $val;
}
$val = 2;
$pow = 3;
echo "VI задание: $val в степени $pow равно " . power($val, $pow);
?><br><br>

<!--7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:-->
<!--22 часа 15 минут-->
<!--21 час 43 минуты-->

<?php
function getTime() {
    date_default_timezone_set('Europe/Moscow');
    return date('h:i');
}

function getHour($hour) {
    if ($hour == 02 || $hour == 03 || $hour == 04 || $hour == 22 || $hour == 23) {
        return " часа ";
    }
    if ($hour == 01 || $hour == 21) {
        return " час ";
    }
    return " часов ";
}

function getMin($min) {
    if ($min == 01 || $min == 21 || $min == 31 || $min == 41 || $min == 51) {
        return " минутa";
        }
    if ($min == 02 || $min == 22 || $min == 32 || $min == 42 || $min == 52 ||
        $min == 03 || $min == 23 || $min == 33 || $min == 43 || $min == 53 ||
        $min == 04 || $min == 24 || $min == 34 || $min == 44 || $min == 54) {
        return " минуты";
    }
    return " минут";
}

function showTime() {
    $time = getTime();
    $min = substr($time, 3, 2);
    $hour = substr($time, 0, 2);
    return $hour . getHour($hour) . $min . getMin($min);
}
echo "VII задание: " . showTime();
?>

<!---->
<!--5. Посмотреть на встроенные функции PHP. -->
<!--Используя имеющийся HTML-шаблон, вывести текущий год в подвале при помощи встроенных функций PHP.-->
<br>
<?php
$date = date("Y");
include "footer.php";
?>