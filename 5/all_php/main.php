<?php
require_once "db.php";

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

$result = mysqli_query($db, "SELECT * FROM images ORDER BY viewed DESC");

$gallery = "";

while ($row = mysqli_fetch_assoc($result)) {
    $pathSmall = $row['path_to_small'];

$id = $row['id'];

    $gallery = $gallery .
        "<a href='show_image.php?id=$id'>
         <img src= \"$pathSmall\" alt=\"Mango\">
        </a>
        ";
}
$gallery = "<div class=\"gallery container\">" . $gallery . "</div>";
echo $gallery;

mysqli_close($db);