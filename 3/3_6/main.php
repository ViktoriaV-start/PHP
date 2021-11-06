<?php

$menuArr = [
        'home' => ['#'],
        'men' => ['#'],
    'women' => ['#'],
    'kids' => ['#'],
    'accesories' => ['#'],
    'featured' => ['#'],
    'hot deals' => ['#'],
];

function render($content)
{
    $temp = '';
    $tempUl = '';

    foreach ($content as $key => $value) {
        foreach ($value as $item) {
            //$temp = $temp . "<a href=\"$item\">$key</a>";
            $tempUl = $tempUl . "<li><a href=\"$item\">$key</a></li>";
        }
    }
    //$temp = "<nav class=\"navigation\">$temp</nav>";
    $tempUl = "<ul class=\"navigation\">$tempUl</ul>";

    return $tempUl;
}
$menu = render($menuArr);

echo $menu;

?>