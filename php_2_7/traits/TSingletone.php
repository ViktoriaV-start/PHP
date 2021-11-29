<?php
namespace app\traits;

// Кусок кода класса
trait TSingletone
{
    private static $instance = null; //здесь будет храниться экземпляр Db,
    // состояние принадлежит и сохраняется в классе

    private function  __construct() {}
    private function  __clone() {}
    private function  __wakeup() {} // Запретить создание экземпляра подключения (3 варианта создания объектов)

    /**
     * @return static
     */

    // статичная ф-ция, которая принадлежит классу и вызывается через класс.
    //Эта ф-ция будет создавать экземпляр Db c подключением,
    //сохранять этот экземпляр в private static $instance и возвращать его.
    public static function getInstance() {
        if (is_null(static::$instance)) {
            static::$instance = new static(); // new static()= new Db()
        }
        return static::$instance; // возвращает экземпляр класса Db c подключением
    }
}