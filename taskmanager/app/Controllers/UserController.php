<?php
require_once 'app/models/user.php';

class UserController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = new User();
            if ($user->register($username, $password)) {
                header('Location: /taskmanager/user/login');
                exit;
            } else {
                $error = "ثبت نام با مشکل مواجه شد.";
            }
        }

        require_once 'views/head.php';
        require_once 'views/register.php';
        require_once 'views/footer.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = new User();
            if ($user->login($username, $password)) {
                session_start();
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;

                header('Location: /taskmanager/');
                exit;
            } else {
                $error = "نام کاربری یا رمز عبور اشتباه است.";
            }
        }

        require_once 'views/head.php';
        require_once 'views/login.php';
        require_once 'views/footer.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /taskmanager/user/login');
        exit;
    }
}
