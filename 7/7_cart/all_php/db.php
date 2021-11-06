<?php

$db = mysqli_connect('localhost:8889', 'root', 'root', 'brand_shop');
if (!$db) {
    die('db error ' . mysqli_connect_error());
}

//function getDb() {
//    static $db = '';
//    if (empty($db)) {
//        $db = mysqli_connect('localhost:8889', 'root', 'root', 'brand_shop');
//    }
//    return $db;
//}