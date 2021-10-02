<?php

namespace app\controllers;

use app\Router;
use app\models\User;
USE app\Authentication;

class UserController
{
    public static function index(Router $router)
    {
        $user=$router->db->getUsers();
        $router->renderView('users/index', [
            'user' => $user
        ]);
    }
    public static function create(Router $router)
    {
        $errors = [];
        $userData = [
            'username' => "",
            'firstname' => "",
            'lastname' => "",
            'email' => "",
            'password' => "",
            'password_confirm' => "",

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $userData['username'] = $_POST['username'];
            $userData['firstname'] = $_POST['firstname'];
            $userData['lastname'] = $_POST['lastname'];
            $userData['email'] = $_POST['email'];
            $userData['password'] = $_POST['password'];
            $userData['password_confirm'] = $_POST['password_confirm'];

            $user= new User();
            $user->load($userData);
            $errors= $user->save();
            if (empty($errors)){
                header('Location: /users');
                exit;
            }

        }
        $router->renderView('users/register', [
            'user' => $userData,
            'errors' => $errors
        ]);
    }
    public static function login(Router $router)
    {
        $errors = [];
        $userData = [
            'username' => "",
            'password' => "",

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $userData['username'] = $_POST['username'];
            $userData['password'] = $_POST['password'];

            $user= new User();
            $user->loadLoginInfo($userData);
            $errors= $user->saveLoginInfo();
            if (empty($errors)){
                header('Location: /users');
                exit;
            }

        }
        $router->renderView('users/login', [
            'user' => $userData,
            'errors' => $errors
        ]);
    }
    public static function logout(Router $router){
        $authentication= new Authentication;
        $authentication->logout();

        $router->renderView('/', []);
    }
}