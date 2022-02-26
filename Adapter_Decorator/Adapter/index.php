<?php

spl_autoload_register(function ($classname) {
    require_once ($classname.'.php');
});

$adapter = new Adapter();
$adapter->squareArea(3);
$adapter->circleArea(35);