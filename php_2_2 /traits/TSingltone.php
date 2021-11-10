<?php

namespace app\traits;

trait TSingltone
{

    private static $instance = null; // статичная переменная, единственная и принадлежит классу,
    // состояние сохраняется в классе

    private function __construct() { }

    public static function getInstance() {
        //var_dump(static::$instance); // при первом обращении = null;
        // при последующих обращения уже не null, а объект
        if (is_null(static::$instance)) {
            var_dump("Успешное и единственное подключение к БД");

            static::$instance = new static(); //ЗДЕСЬ СОЗДАЕТСЯ ЭКЗЕМПЛЯР БД ... = new Db();
            // так тоже можно записать, static() используется чтобы не было проблем с именем,
            // это обращение к самому себе, при этом так лучше обращаться, чем self.
            //Здесь будет сохранен экземпляр Db, который и будет возвращаться при обращении
        }
        //var_dump(static::$instance);
        return static::$instance;
    }

}