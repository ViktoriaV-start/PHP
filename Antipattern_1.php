<!-- АНТИПАТТЕРНЫ -->


<!--I ФАЙЛ


1) Спагетти-код
2) Большой ком грязи (отсутствие архитектуры)
3) Слепая вера - нет проверки, что приходит по запросу из БД
-->




<!--
II ФАЙЛ 

 4) Спагетти-код
 5) Магические числа
 6) Слепая вера - предполагаю, что мало проверок для приходящего файла
-->

<!-- 
7) Использование Singltone в проекте PHP-2, как я понимаю,
является антипаттерном. (Не включаю здесь код для Singltone)
-->

<!--
РЕШЕНИЕ
Добавить проверки для приходящих данных, даже если данные приходят из БД.
Магические числа/ строки выносить в константы в файл конфиг.
Делать структуру проекта.
Вот как быть с синглтоном - не очень ясно. Там он используется в двух местах
и придется отдельно добавлять код с созданием уникального объекта.
-->



<?php


session_start();
$allow = false;

function getDb()
{ // 1) Подключение к БД
    static $db = '';
    if (empty($db)) {
        $db = mysqli_connect('localhost:8889', 'root', 'root', 'brand_shop');
        if (!$db) {
            die('db error ' . mysqli_connect_error());
        }
    }
    return $db;
}

function get_user() // 6) Возвращает имя пользователя
{
    return $_SESSION['name']; // взять из сессии имя пользователя
}


// 3) ПРОВЕРКА
function auth($login, $pass)
{
    $db = getDb();
    $login = mysqli_real_escape_string($db, strip_tags(stripslashes($login))); // очистить введенный логин
    $result = mysqli_query($db, "SELECT * FROM users WHERE login = '{$login}'"); // 3) Найти пользователя по
    // его уникальному логину - будет одна запись
    $row = mysqli_fetch_assoc($result); // 4) прочитать эту единственную строку либо ничего не вернет
    //password_verify()
    $name = $row['name'];

    if ($pass == $row['pass']) {
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $name;
        return true;
    }
    return false;
}


if (isset($_GET['logout'])) {
    setcookie('hash', '', time() - 3600, '/');
    session_destroy();
    header('Location: index.php'); // перенаправить на страницу входа
    die();
}

// ПРИ НОВОМ ВХОДЕ (может быть с СОХРАНЕННЫМ В КУКИ ХЭШЕМ):
if (is_auth()) { // вызвать ф-цию is_auth
    $allow = true;
    $user = get_user();

}


function is_auth()
{ // 5)
    //TODO оптимизируйте if, и учтите что пользователь уже может быть авторизован по сессии


    if (isset($_COOKIE["hash"])) {
        $hash = $_COOKIE["hash"];

        $db = getDb();
        $sql = "SELECT * FROM `users` WHERE `hash`='{$hash}'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $user = $row['name'];
        $login = $row['login'];


        if (!empty($login)) { // если $login не пустой (нашли строку в БД):
            $_SESSION['name'] = $user;
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $row['id'];
        }


    } elseif ($_SESSION['login'] !== '') {

        return isset($_SESSION['login']);

    }

    return isset($_SESSION['login']); // если сессия создана  и наполнена введенными данныит,
    // значит клиент зашел, а кто вошел - вернет ф-ция get_user.
    //если еще данные не введены - вернется false.
}


// 1) ТОЧКА СТАРТА - получение введенных данных
if (isset($_POST['ok'])) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

// 2)
    if (auth($login, $pass)) { // здесь вызывается ф-ция auth проверки данных, которая возвращает либо true, либо false
        if (isset($_POST['save'])) { // если пользователь желает сохранить данные для входа - сохраняем их в куки
            $hash = uniqid(rand(), true); // получить уникальный хэш
            $db = getDb();
            $id = $_SESSION['id']; // здесь обращение к существующей сессии, откуда запрашиваем сохраненный id
            $sql = "UPDATE `users` SET `hash` = '{$hash}' WHERE `users`.`id` = {$id}";
            $result = mysqli_query($db, $sql);
            setcookie("hash", $hash, time() + 3600, '/'); // УСТАНОВИТЬ КУКУ С ХЭШЕМ
        }
        header('Location: client_page.php'); // перенаправить на страницу клиента
        die();
    } else {
        die("Incorrect login/password");
    }
}

//II ФАЙЛ ----------------------------------------------------------------
//
//
// 4) Спагетти-код
// 5) Магические числа
// 6) Слепая вера - предполагаю, что мало проверок для приходящего файла

//
//<form class="container" action="" method="post" enctype="multipart/form-data">
//<input class="browse__text" type="file" name="myfile">
//<input class="input" type="submit" value="Load file">
//</form>



$messages = [
    'OK' => 'File is uploaded',
    'ERROR' => 'Error',
];

if (isset($_FILES['myfile'])) {
    $path = "img_loaded/" . $_FILES['myfile']['name'];
}

if($_FILES["myfile"]["size"] > 1024*5*1024)
{
    echo ("<div class='container browse__text'>File's size should be less than 5MB</div>");
    exit;
}

$imageInfo = getimagesize($_FILES['myfile']['tmp_name']);
if(getimagesize($_FILES['myfile']['tmp_name'])
    && $imageInfo['mime'] != 'image/gif'
    && $imageInfo['mime'] != 'image/jpeg'
    && $imageInfo['mime'] != 'image/png'
    && $imageInfo['mime'] != 'image/svg+xml')
{
    echo "Можно загружать только jpg, gif png, svg -файлы, неверное содержание файла, не изображение";
    exit;
}

if($_FILES['myfile']['type'] && $_FILES['myfile']['type'] != "image/jpeg"
    && $_FILES['myfile']['type'] != 'image/gif'
    && $_FILES['myfile']['type'] != 'image/jpeg'
    && $_FILES['myfile']['type'] != 'image/png'
    && $_FILES['myfile']['type'] != 'image/svg+xml')
{
    echo "Можно загружать только jpg, gif png, svg -файлы, неверное содержание файла, не изображение";
    exit;
}

if (move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
    $message = "Файл загружен!";
    echo "<div class='container'><img src=$path alt ='client' width='200'><span class='browse__text'>$message</span></div>";
    header("Location: /?message=OK");
    die();

} else {
    $message = "Файл не загружен";
    echo "<div class='container'>$message</div>";
    header("Location: /?message=ERROR");
    die();

};

$message = $messages[$_GET['message']];
include 'index.php';
