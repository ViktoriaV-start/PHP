<?php

session_start();

require "db.php";

$_SESSION['session_id'] = $_COOKIE['PHPSESSID'];
$session = $_SESSION['session_id'];


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

if ($_GET['action'] == 'buy') {

    $product_id = (int)$_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM carts WHERE product_id = '{$product_id}' AND session_id = '$session';");
    if (!mysqli_fetch_assoc($result)) {
        mysqli_query($db, "INSERT INTO `carts`(`session_id`, `product_id`) VALUES ('{$session}','{$product_id}')");
    } else {
        mysqli_query($db, "UPDATE carts SET quantity = quantity + 1 WHERE product_id = '{$product_id}' AND session_id = '$session';");
    }
    $_GET['action'] == '';
    var_dump($_GET);
}

$sql = "SELECT products.id, 
               products.name, 
               products.price,
               images.path_to_big,
               images.path_to_small
          FROM products
          JOIN images
            ON products.id = images.product_id;";

$result = mysqli_query($db, $sql);
$calc_quantity = mysqli_query($db, "SELECT SUM(quantity) as total_quantity FROM carts WHERE session_id = '$session';");
$total_quantity = (mysqli_fetch_assoc($calc_quantity))['total_quantity'];


$gallery = "";

while ($row = mysqli_fetch_assoc($result)) {
    $pathSmall = $row['path_to_small'];
    $pathBig = $row['path_to_big'];
    $name = $row['name'];
    $price = $row['price'];
    $id = $row['id'];


    $gallery = $gallery .
        "      
        <figure class='promo__card'>
            <img src= \"$pathBig\" alt=\"Mango\">
            <figcaption class='promo__mango'>
                <h3 class='promo__mangoName'>{$name}</h3> 
                <span class='promo__mangoPrice'>{$price}.00</span>
            </figcaption>
            <div class='promo__cardHover'></div>
                
            <a href='?action=buy&id={$id}'
                <div class='promo__cardHoverCart add'> 
                    <svg class='whiteCart add' fill='rgb(255, 255, 255)' width='32' height='29' viewBox='0 0 32 29'>
                        <path class='add' d='M31.899,7.565 L26.493,19.977 C26.296,20.410 25.882,20.686 25.409,20.686 L10.554,20.686 C10.021,20.686 9.548,20.331 9.410,19.819 L4.577,2.364 L1.184,2.364 C0.533,2.364 -0.000,1.832 -0.000,1.182 C-0.000,0.532 0.533,-0.001 1.184,-0.001 L5.464,-0.001 C5.997,-0.001 6.471,0.354 6.609,0.866 L11.442,18.322 L24.620,18.322 L28.999,8.274 L14.401,8.274 C13.750,8.274 13.217,7.742 13.217,7.092 C13.217,6.442 13.750,5.910 14.401,5.910 L30.814,5.910 C31.208,5.910 31.583,6.107 31.800,6.442 C32.017,6.777 32.057,7.190 31.899,7.565 ZM9.429,23.641 C10.909,23.641 12.112,24.843 12.112,26.320 C12.112,27.798 10.909,28.999 9.429,28.999 C7.950,28.999 6.747,27.798 6.747,26.320 C6.747,24.843 7.950,23.641 9.429,23.641 ZM26.020,23.641 C27.500,23.542 28.782,24.665 28.881,26.123 C28.920,26.852 28.703,27.542 28.230,28.073 C27.756,28.625 27.105,28.940 26.395,28.999 C26.336,28.999 26.257,28.999 26.198,28.999 C24.797,28.999 23.633,27.896 23.535,26.498 C23.436,25.040 24.541,23.739 26.020,23.641 Z' /> 
                    </svg> 
                    <span class='promo__addToCart add'>Add to cart</span> 
                </div>
            </a>
                
        </figure>
        
        ";
}



$gallery = "
    <a href='cart.php'>
        <div class='go-to-cart container'>
            <svg width='32' height='29' viewBox='0 0 32 29'>
                <path d='M31.899,7.565 L26.493,19.977 C26.296,20.410 25.882,20.686 25.409,20.686 L10.554,20.686 C10.021,20.686 9.548,20.331 9.410,19.819 L4.577,2.364 L1.184,2.364 C0.533,2.364 -0.000,1.832 -0.000,1.182 C-0.000,0.532 0.533,-0.001 1.184,-0.001 L5.464,-0.001 C5.997,-0.001 6.471,0.354 6.609,0.866 L11.442,18.322 L24.620,18.322 L28.999,8.274 L14.401,8.274 C13.750,8.274 13.217,7.742 13.217,7.092 C13.217,6.442 13.750,5.910 14.401,5.910 L30.814,5.910 C31.208,5.910 31.583,6.107 31.800,6.442 C32.017,6.777 32.057,7.190 31.899,7.565 ZM9.429,23.641 C10.909,23.641 12.112,24.843 12.112,26.320 C12.112,27.798 10.909,28.999 9.429,28.999 C7.950,28.999 6.747,27.798 6.747,26.320 C6.747,24.843 7.950,23.641 9.429,23.641 ZM26.020,23.641 C27.500,23.542 28.782,24.665 28.881,26.123 C28.920,26.852 28.703,27.542 28.230,28.073 C27.756,28.625 27.105,28.940 26.395,28.999 C26.336,28.999 26.257,28.999 26.198,28.999 C24.797,28.999 23.633,27.896 23.535,26.498 C23.436,25.040 24.541,23.739 26.020,23.641 Z' /> </svg>
        <span> {$total_quantity} </span>
        </div>
    </a>
            
    <section class='promo__wrap container'>" . $gallery . "</section>";
echo $gallery;



mysqli_close($db);
