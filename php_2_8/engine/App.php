<?php

namespace app\engine;

use app\model\repositories\CartRepo;
use app\model\repositories\ProductRepo;
use app\model\repositories\UserRepo;
use app\engine\Session;
use app\traits\TSingletone;


//это даем задание шторму на подсказки, чтобы находил имена классов и их методы
/**
 * Class App
 * @property Request $request
 * @property Db $db
 * @property CartRepo $cartRepo
 * @property ProductRepo $productRepo
 * @property UserRepo $userRepo
 * @property OrderRepo $orderRepo
 *
 */
class App
{

    use TSingletone;

    public $config;
    private $components; //new Storage();
    private $controller;
    private $action;


    public function run($config) {


        $this->config = $config;

        $this->components = new Storage();

        $this->runController();

    }


    public function  runController() {

        $this->controller = $this->request->getControllerName() ?: 'product';

        $this->action = $this->request->getActionName();
        $controllerClass = $this->config['controllers_namespace'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();  // cоздать экземпляр класса контроллера
            $controller->runAction($this->action); // здесь получим имя метода в этом конкретном контроллере
        } else {
            echo 'Wrong controller';
        }
    }

    /**
     * @return static // дать подсказки
     */
    public static function call()
    {
        return static::getInstance(); // это из файла TSingletone
    }

    public function createComponent($name) {

        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name]; // извлекаем все параметры из конфига, которые относятся к компоненту
            $class = $params['class'];

            if (class_exists($class)) {
                unset($params['class']);//имя класса для конструктора класса не нужно, убираем из параметров

                $reflection = new \ReflectionClass($class); // Доп. модуль: который по полному имени класса $class(по namespace)
                // может построить новый экемпляр по имени (есть и другие методы внутри). Парамс передаем.

                return $reflection->newInstanceArgs($params); // вот здесь строит новый экземпляр

            }
        }
        return null;
    }

    public function __get($name)
    {
        return $this->components->get($name);
        // обратиться к экземпляру Storage и вызвать у него метод get и предать ему имя и получить запрашиваемый экземпляр
    }
}