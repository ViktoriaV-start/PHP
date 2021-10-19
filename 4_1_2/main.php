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
$imgBig = "img_big/";
$imgSmall = "img_small/";
$files = array_splice(scandir($imgSmall), 2);
//var_dump(scandir("img_big/"));
//
//var_dump($files);



function renderGallery($arr, $imgBig, $imgSmall)
{
    $gallery = "";
    foreach ($arr as $item) {
        $gallery .= "<a href=\"$imgBig$item\" target=\"_blank\"><img src=\"$imgSmall$item\" alt=\"Mango\"></a>";
    }

    $gallery = "<div class=\"gallery container\">" . $gallery . "</div>";
    return $gallery;
}


echo renderGallery($files, $imgBig, $imgSmall);
?>