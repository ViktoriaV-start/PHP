<?php

namespace app\engine;
use app\traits\TSingletone;

class Db
{
    private $config = [ // настройки для PDO
        'driver' => 'mysql',
        'host' => 'localhost:8889',
        'login' => 'root',
        'password' => 'root',
        'database' => 'brand_shop',
        'charset' => 'utf8'
    ];

    use TSingletone;
    protected $connection = null;  // объект PDO будем хранить непосредственно в поле класса Db.

    // Закрытый метод, который будет возвращать соединение - экземпляр PDO
    protected function getConnection() {
        if (is_null($this->connection)) {

            $this->connection = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']);

           $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
           //установили атрибут вывода-загрузки данных
        }
        return $this->connection;
    }

    // Ф-ция для подготовки половины строки для подключения через PDO
    protected function prepareDsnString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public  function lastInsertId() {
        return $this->connection->lastInsertId(); // встроенная PDO ф-ция на получение последнего вставленного id
    }

    protected function query($sql, $params) {
        $stmt = $this->getConnection()->prepare($sql); //обращение к connection,
        //который либо создаст новое подключение, либо вернет новое.
        $stmt->execute($params); // если параметры переданы, execute сам все сделает,
        // забиндит параметры и выполнит и вернет объект PDO
        return $stmt;
        // Готовит любой запрос и тут же его выполняет
        // prepare/ execute - собственные методы PDO
}

    public function queryLimit($sql, $page) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(1, $page, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function queryOne($sql, $params){
//        var_dump($this->query($sql, $params)->fetch());
        return $this->query($sql, $params)->fetch();
        // полученные параметры пробрасываются в query.
        // fetch уже вернет ассоциативный массив, как указано при подключении.
        // Здесь возвращается одна строка.
    }

    public function queryOneObj($sql, $params, $class){

        $stmt = $this->query($sql, $params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
         // Третий параметр - имя класса, который нужно создать - меняется режим для создания класса,
        // имя которого передаем.

        return $stmt->fetch(); // метод fetch создаст новый экземпляр uswer/product ...класса, который передаем,
        // с уже заполненными полями, значения которых берутся из БД. Все методы, которые относятся к данному классу,
        //будут доступны и этому новому объекту.
    }



    public function queryAll($sql, $params = []){
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = []){
        return $this->query($sql, $params)->rowCount();
    }
}