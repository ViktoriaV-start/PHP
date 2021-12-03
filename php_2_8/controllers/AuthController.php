<?php
namespace app\controllers;
use app\engine\Render;
use app\model\entities\User;
use app\engine\Request;
use app\model\repositories\UserRepo;
use app\engine\App;
use app\engine\Session;

class AuthController extends Controller
{
    public static $message = "WELCOME";

    public function actionIndex() { // в названии используем Index - чтобы по умолчанию
        // строилось имя метода actionIndex в экземпляре класса Cart
        //echo $this->render('index');

        if (App::call()->session->getSession('login')) {
            $this->rend->renderUser(static::$message);
        } else {
            return $this->rend->renderAuth(static::$message);
        }
    }

    public function actionAccount() {
        return $this->rend->renderUser(static::$message);
    }

    public function actionLogout() {
        session_destroy();
        setcookie('hash', '', time()-3600, '/');
        header('Location: /product'); // перенаправить на страницу входа
        die();
    }

    public function actionLogin() {
        $request = new Request();
        $login = $request->getParams()['email'];
        $pass = $request->getParams()['password'];

        if ((new UserRepo())->auth($login, $pass)) {

            if (App::call()->cartRepo->getCart()) {
                header('Location: /cart/ordering');
                die();
            } else {
                $this->actionAccount();
            }

        } else {

            die("Incorrect login/password");
        }
    }

    public function actionRegistration() {
        $request = new Request();
        $login = $request->getParams()['email'];
        $name = $request->getParams()['name'];
        $surname = $request->getParams()['surname'];
        $email = $request->getParams()['email'];
        $address = $request->getParams()['address'];
        $phone = $request->getParams()['phone'];
        $pass = $request->getParams()['password'];
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        if(App::call()->userRepo->getWhere('login', $login)) {
            echo "User with this email exists. Log in with password";
        } else {
            $newUser = new User($login, $name, $surname, $email, $phone, $address, $pass, $hash);

            App::call()->userRepo->insert($newUser);

            App::call()->userRepo->saveUser($newUser);

            if (App::call()->cartRepo->getCart()) {
                header('Location: /cart/ordering'); // перенаправить на страницу входа
                die();
            } else {
                header('Location: /product'); // перенаправить на страницу входа
                die();
            }



        }

//        if ((new UserRepo())->auth($login, $pass)) {
//            $this->actionAccount();
//        } else {
//
//            die("Incorrect login/password");
//        }
    }
}














