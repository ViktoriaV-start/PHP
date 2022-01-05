<?php

namespace app\controllers;
use app\engine\Render;
use app\model\User;



class AuthController extends Controller
{

    public static $message = "WELCOME";

    public function actionIndex() { // в названии используем Index - чтобы по умолчанию
        // строилось имя метода actionIndex в экземпляре класса Cart
        //echo $this->render('index');
var_dump(static::$message);
        return $this->rend->renderAuth(static::$message);
    }



    public function actionAccount() {
        return $this->rend->renderUser(static::$message);
    }

    public function actionLogout() {
        session_destroy();
        header('Location: /product'); // перенаправить на страницу входа
        die();
    }

    public function actionLogin() {


        $user=User::findLogin($_POST[email]);

            if (!$user) {
                static::$message = 'Error';
                var_dump(static::$message);
                header('Location: /auth'); // перенаправить на страницу auth
            die();
            }

            if ($this->auth($user)) { // здесь вызывается ф-ция auth проверки данных, которая возвращает либо true, либо false
                $this->actionAccount();




//                if (isset($_POST['save'])) { // если пользователь желает сохранить данные для входа - сохраняем их в куки
//                    $hash = uniqid(rand(), true); // получить уникальный хэш
//                    $db = getDb();
//                    $id = $_SESSION['id']; // здесь обращение к существующей сессии, откуда запрашиваем сохраненный id
//                    $sql = "UPDATE `users` SET `hash` = '{$hash}' WHERE `users`.`id` = {$id}";
//                    $result = mysqli_query($db, $sql);
//                    setcookie("hash", $hash, time() + 3600, '/'); // УСТАНОВИТЬ КУКУ С ХЭШЕМ
//                }
//                header('Location: client_page.php'); // перенаправить на страницу клиента
//                die();
            } else {
                die("Incorrect login/password");
            }


    }

    public function auth($user) {

        if ($user->pass == $_POST[password]) {
            $_SESSION['login'] = $user->login;
            $_SESSION['id'] = $user->id;
            $_SESSION['name'] = $user->name;
            return true;
        } else {
            return false;
        }

    }


}














