<?php
spl_autoload_register(function ($classname) {
    require_once $classname . ".php";
});



// УРОК 7
// ------------------------------------------------------------------------------------------------
//1. Найти и указать в проекте Front Controller и расписать классы, которые с ним взаимодействуют.

// Front Controller находится в файле Kernel.php - protected function process(Request $request).
// Здесь создаются следующие классы:

// UrlMatcher
// RequestContext
// RequestContext
// Session
// ControllerResolver
// ArgumentResolver
// Response

// Обращается к Registry.


//    protected function process(Request $request): Response
//    {
//        $matcher = new UrlMatcher($this->routeCollection, new RequestContext());
//        $matcher->getContext()->fromRequest($request);
//
//        try {
//            $request->attributes->add($matcher->match($request->getPathInfo()));
//            $request->setSession(new Session());
//
//            $controller = (new ControllerResolver())->getController($request);
//            $arguments = (new ArgumentResolver())->getArguments($request, $controller);
//
//            return call_user_func_array($controller, $arguments);
//        } catch (ResourceNotFoundException $e) {
//            return new Response('Page not found. 404', Response::HTTP_NOT_FOUND);
//        } catch (\Throwable $e) {
//            $error = 'Server error occurred. 500';
//            if (Registry::getDataConfig('environment') === 'dev') {
//                $error .= '<pre>' . $e->getTraceAsString() . '</pre>';
//            }
//
//            return new Response($error, Response::HTTP_INTERNAL_SERVER_ERROR);
//        }
//    }

// ------------------------------------------------------------------------------------------------

// 2.	Найти в проекте паттерн Registry и объяснить, почему он был применён.

// Файл app/framework/Registry.php - это реализация паттерна Registry.

// Создаются:
// единственная переменная - private static $containerBuilder - приватная.
// Все методы - также приватные:
// - public static function addContainer(ContainerBuilder $containerBuilder);<- получает контейнер и записывает в поле;
// - public static function getDataConfig(string $name);                     <- запрашивает и возвращает данные из контейнера;
// - public static function getRoute(string $name, array $parameters = []);  <- возвращает ответ, подготовленный на основе данных из контейнера.

// В $containerBuilder сохраняется переданный экземпляр класса ContainerBuilder.

// Как я понимаю, $containerBuilder будет хранить ссылку на конфигурационный файл
// с определенными параметрами, которые требуются для работы всего приложения,
// должны быть неизменными в течение всей работы и доступными для разных страниц.
// Именно поэтому создается класс с паттерном Registry.
// $containerBuilder - приватная, поэтому к ней нет доступа снаружи для изменения данных,
// а в классе определены публичные методы, которые позволяют только запрашивать данные/параметры
// из контейнера (плюс еще один метод, который устанавливает контейнер).


// ------------------------------------------------------------------------------------------------

// 3.	Добавить во все классы Repository использование паттерна Identity Map вместо постоянного генерирования сущностей.

// ДОБАВИЛА ДЛЯ КЛАССА Product. Код рабочий. Для класса User - аналогично:
// запрашивается экземпляр IdentityMap и в поле private $identityMap = [] записываются загружаемые данные,
// если по ключу данные не найдены. Ключ будет User.1 (User.id).

// Если необходимо показать код и для класса User - напишите и я скину в следующем ДЗ.

$test1 = new Product();
$all = $test1->fetchAll();
echo "Выполнен метод fetchAll()";
var_dump($all);

$test2 = new Product();

$search = $test2->search([1, 3, 5]);
echo "Выполнен метод search([1, 3, 5])";
var_dump($search);
