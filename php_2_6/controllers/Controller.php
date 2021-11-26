<?php
namespace app\controllers;
use app\engine\Render;
class Controller
{
    private $action;
    private $defaultAction = 'index';
    public $rend;

//    private $defaultLayout = 'main';
//    private $useLayout = true;

    public function __construct()
    {
        $this->rend = new Render(); // cjздаем экземпляр класса Рендер и сохраняем в переменную $rend

    }

    public function runAction($action = null) {
        $this->action = $action ?: $this->defaultAction; // сохранить действие: добавить/удалить/
        // показать один товар/показать или перейти в корзину
        // в $action присваивается пришедшее значение (add, delete, cart ...)
        // ?: означает, что если ничего не пришло - использовать $defaultAction = 'index'
        $method = "action" . ucfirst($this->action); // получить имя метода: actionIndex
        //var_dump($method); // 'actionIndex'
//        $data = file_get_contents("php://input");
//        var_dump($data);

        // Если в урл поставить/?c=product&a=card - результат: $method = 'actionCard'

        if (method_exists($this, $method)) {
            $this->$method(); // ЗАПУСК НУЖНОГО КОНТРОЛЛЕРА
        }
    }
}