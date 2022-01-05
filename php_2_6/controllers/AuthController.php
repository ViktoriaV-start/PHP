<?php
namespace app\controllers;
use app\engine\Render;
use app\model\User;
use app\engine\Request;

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
        $request = new Request();
        $login = $request->getParams()['email'];
        $pass = $request->getParams()['password'];

        if (User::auth($login, $pass)) {
            $this->actionAccount();
        } else {

            die("Incorrect login/password");
        }
    }
}














