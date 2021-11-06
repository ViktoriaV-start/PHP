<?php
require_once "db.php";

$session = $_COOKIE['PHPSESSID'];


if ($_GET['action'] == 'delete') {
    $product_id = (int)$_GET['id'];
    $result = mysqli_query($db, "SELECT * FROM carts WHERE product_id = '{$product_id}' AND session_id = '$session';");
    $row = mysqli_fetch_assoc($result);
    $quantity = $row['quantity'];
    if ($quantity > 1) {
        mysqli_query($db, "UPDATE carts SET quantity = quantity - 1 WHERE product_id = '{$product_id}' AND session_id = '$session';");
    } else {
        mysqli_query($db, "DELETE FROM carts WHERE product_id = '{$product_id}' AND session_id = '$session';");
    }

}

$sql = "SELECT carts.session_id,
	           products.id,
	           products.name,
               products.price,
               carts.quantity,
               images.path_to_big,
               images.path_to_small

          FROM carts
          JOIN products
            ON products.id = carts.product_id
          JOIN images
            ON images.product_id = products.id
         WHERE carts.session_id = '{$session}';";

$result = mysqli_query($db, $sql);

$gallery = "";

while ($row = mysqli_fetch_assoc($result)) {
    $pathSmall = $row['path_to_small'];
    $pathBig = $row['path_to_big'];
    $name = $row['name'];
    $price = $row['price'];
    $id = $row['id'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $session_id = $row['session_id'];
    $subtotal = $price * $quantity;



    $gallery = $gallery .
        "      
        
<div class = 'shoppingCart__line'>
            <div class='shoppingCart_productDetails'>
                <img class='shoppingCart__productPhoto' src='{$pathSmall}' alt='Added Product'>
                <div class='shoppingCart__detailsWrapper'><span class='shoppingCart__productName'>{$name}</span></div>
                
            </div>

            <span class='shoppingCart__data'>{$price}</span>

            <div class='shoppingCart__dataInput'>
                <div class='shoppingCart__quantityWrap'>
                    

                    <span  class='shoppingCart__quantity'>{$quantity}</span>
                
                    
                </div>

            </div>

            <span class='shoppingCart__data'>FREE</span>
            <span class='shoppingCart__data shoppingCart__price'>\${$subtotal}</span>
            
            <a href='?action=delete&id={$id}' class='shoppingCart__deleteWrapper'>
            <button class='btn-delete'>
                <svg class='shoppingCart__delete' fill='currentColor' height='15' width='15' viewBox='0 0 512 512'><path class='shoppingCart__dlt'  d='M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z'></path></svg>
            </button>
            </a>
</div>
        
        ";
}

echo $gallery;






mysqli_close($db);