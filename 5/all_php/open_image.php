<?php
require_once "db.php";
$id = $_GET['id'];

mysqli_query($db, 'UPDATE images SET viewed = viewed + 1 WHERE id = ' . $id);
$result = mysqli_query($db, 'SELECT * FROM images WHERE id = ' . $id);
$image = mysqli_fetch_assoc($result);
$pathBig = $image['path_to_big'];
$quantityViews = $image['viewed'];
if ($image) {
    echo '
        <div class="container">
        <img src =' . $pathBig . '>
        <span class="text">Quantity of views: ' . $quantityViews = $image['viewed'] . ' </span>
        </div>
        
        ';
}

mysqli_close($db);