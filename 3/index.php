I задание <br>
<?php

set_time_limit(2);

//1. С помощью цикла while вывести все числа в промежутке от 0 до 100,
//которые делятся на 3 без остатка.
//
$i = 0;

while ($i <= 100) {
    if ($i == 0 || $i % 3 != 0 )
        $i++;
    else {
        echo $i; ?><br><?php
        $i++;
    }
}

//2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат выглядел так:
//0 – ноль.
//1 – нечетное число.
//2 – четное число.
//3 – нечетное число.
?><br><br>II задание<br><?php

$j = 0;
do {
    if ($j == 0) {
        echo $j . " - ноль"; ?><br><?php
        $j++;
    }
    if ($j % 2 == 0) {
        echo $j . " - четное число"; ?><br><?php
        $j++;
    } else {
        echo $j . " - нечетное число"; ?><br><?php
        $j++;
    }
} while ($j <= 10);

?><br><br>III задание<br><?php
//3. Объявить массив, в котором в качестве ключей будут использоваться названия областей,
// а в качестве значений – массивы с названиями городов из соответствующей области.
// Вывести в цикле значения массива, чтобы результат был таким:
//Московская область:
//Москва, Зеленоград, Клин
//
$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволжск', 'Павловск', 'Кронштадт'],
    'Нижегородская область' => ['Нижний Новгород', 'Арзамас', 'Заволжье', 'Кулебаки'],
    'Тульская область' => ['Тула', 'Белёв', 'Кимовск', 'Плавск']
];

function getRegions($arr)
{
    $table = "";

    foreach ($arr as $key => $value) {

        $towns = "";

        foreach ($value as $item) {

            $towns = $towns . $item . ", ";
        }
        $towns = rtrim($towns, ", ");
        //$towns = rtrim($towns, ",");

        $table = $table . $key . ":<br>" . $towns . "<br>";
    }
    return $table;
}

echo getRegions($regions);

?><br><br>IV задание<br><?php
//4. Объявить массив, индексами которого являются буквы русского языка,
//а значениями – соответствующие латинские буквосочетания
//(‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
//Написать функцию транслитерации строк.
$alfabet = [
    'а' => 'a',   'б' => 'b',   'в' => 'v',
    'г' => 'g',   'д' => 'd',   'е' => 'e',
    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
    'и' => 'i',   'й' => 'y',   'к' => 'k',
    'л' => 'l',   'м' => 'm',   'н' => 'n',
    'о' => 'o',   'п' => 'p',   'р' => 'r',
    'с' => 's',   'т' => 't',   'у' => 'u',
    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
    'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
    'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
];

function transliterate($str, $alfabet) {
    $strArr = preg_split('//u', $str);
    //var_dump($strArr);
    $strTranslit = [];
    for ($i = 0; $i < count($strArr); $i++) {
        $key = $strArr[$i];

        if($key === "") continue;
        if($key === " ") {
            $strTranslit[$i] = " ";
        } else {
            $strTranslit[$i] = $alfabet[$key];
        }
    }
    //var_dump($strTranslit);
    return implode($strTranslit);
}

$input = "апер троль щука";
echo transliterate($input, $alfabet);

?><br><br>V задание<br><?php

//5. Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.

function changeStr($str) {
    $strArr = explode(" ", $str);
    $strNew = "";
    foreach ($strArr as $value) {
        $strNew = $strNew . $value . "_";
    }
    $strNew = rtrim($strNew, "_");
    return $strNew;
}
echo changeStr($input);

?><br><br>VII задание<br><?php
//7. *Вывести с помощью цикла for числа от 0 до 9, не используя тело цикла. Выглядеть должно так:
//for (…){ // здесь пусто}

for ($i = 0; $i < 10; print $i++) {}


?><br><br>VIII задание<br><?php
//8. *Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».
function getK($arr)
{
    $table = "";

    foreach ($arr as $key => $value) {

        $towns = "";

        foreach ($value as $item) {
            $strArr = preg_split('//u', $item);

            if ($strArr[1] === "К") {
                $towns = $towns . $item . ", ";
            } else continue;
        }
        $towns = rtrim($towns, ", ");
        //$towns = rtrim($towns, ",");

        $table = $table . $key . ":<br>" . $towns . "<br>";
    }
    return $table;
}

echo getK($regions);

?><br><br>IX задание<br><?php

//9. *Объединить две ранее написанные функции в одну, которая получает строку на русском языке,
//производит транслитерацию и замену пробелов на подчеркивания
//(аналогичная задача решается при конструировании url-адресов на основе названия статьи в блогах).

$title = "Ведущие производители чая";

function getUrl($str, $alfabet) {
    $strArr = preg_split('//u', mb_strtolower($str));
    //var_dump($strArr);
    $strTranslit = [];
    for ($i = 0; $i < count($strArr); $i++) {

        $key = $strArr[$i];

        if($key === "") continue;
        if($key === " ") {
            $strTranslit[$i] = "_";
        } else {
            $strTranslit[$i] = $alfabet[$key];
        }
    }
    //var_dump($strTranslit);
    return implode($strTranslit);
}

echo getUrl($title, $alfabet);

?>



