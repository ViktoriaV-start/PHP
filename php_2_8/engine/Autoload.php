<?php

class Autoload
{
    public function loadClass($className) {
//var_dump($className);
        $arr = explode("\\", $className);
        $arr[0] = '..';
        $className = implode("/", $arr);
        $fileName = "{$className}.php";

        include $fileName;
    }
}