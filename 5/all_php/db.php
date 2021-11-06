<?php

$db = mysqli_connect('localhost:8889', 'root', 'root', 'brand_shop');
if (!$db) {
    die('db error ' . mysqli_connect_error());
}