<?php

class IdentityMap
{
    private static $instance;
    private $identityMap = [];

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    public function getIdentityMap() {
        return $this->identityMap;
    }

    public function add($obj)
    {
        $key = $this->getGlobalKey(get_class($obj), $obj->getId());

        $this->identityMap[$key] = $obj;
    }

    public function get(string $classname, int $id)
    {
        $key = $this->getGlobalKey($classname, $id); // "Product.1"

        if (isset($this->identityMap[$key])) {
            return $this->identityMap[$key];
        }

        return false;
    }

    public function getGlobalKey(string $classname, int $id)
    {
        return sprintf('%s.%d', $classname, $id); //"Product.1"
    }
}