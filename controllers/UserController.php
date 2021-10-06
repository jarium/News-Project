<?php

namespace app\controllers;

use app\Router;
use app\models\User;
use app\Authentication;

class UserController
{
    public static function index(Router $router)
    {
        $_id= Authentication::getUserSessionInfo('_id');
        $search = $_GET['search'] ?? '';
        $user=$router->db->getUsersById($_id);
        $comments= $router->db->getCommentsByUserId($_id,$search);
        $comments_count = $router->db->getCommentsCountByUserId($_id);
        

        $router->renderView('users/index', [
            'user' => $user,
            'comments' => $comments,
            'comments_count' => $comments_count
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
            'categories' => []
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $userData['username'] = trim($_POST['username']);
            $userData['firstname'] = trim($_POST['firstname']);
            $userData['lastname'] = trim($_POST['lastname']);
            $userData['email'] = trim($_POST['email']);
            $userData['password'] = $_POST['password'];
            $userData['password_confirm'] = $_POST['password_confirm'];
            
            if (isset($_POST['science'])){
                $userData['categories'][]= 'science';
            }
            if (isset($_POST['health'])){
                $userData['categories'][]= 'health';
            }
            if (isset($_POST['political'])){
                $userData['categories'][]= 'political';
            }
            if (isset($_POST['technology'])){
                $userData['categories'][]= 'technology';
            }
            if (isset($_POST['world'])){
                $userData['categories'][]= 'world';
            }
            if (isset($_POST['economy'])){
                $userData['categories'][]= 'economy';
            }
            if (isset($_POST['sports'])){
                $userData['categories'][]= 'sports';
            }
            if (isset($_POST['art'])){
                $userData['categories'][]= 'art';
            }
            if (isset($_POST['education'])){
                $userData['categories'][]= 'education';
            }
            if (isset($_POST['social'])){
                $userData['categories'][]= 'social';
            }

            $user= new User();
            $user->load($userData);
            $errors= $user->save();
            if (empty($errors)){
                header('Location: /users/login');
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
    public static function logout(){
        $authentication= new Authentication;
        $authentication->logout();

        header('Location: /');
        exit;
      
        
    }
}