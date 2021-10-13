<?php

namespace app\controllers;

use app\Router;
use app\models\User;
use app\Authentication;
use app\Logger\Logger;

class UserController
{

    public static function index(Router $router)
    {   $logger = New Logger;
        $_id= Authentication::getUserSessionInfo('_id');
        $user=$router->db->getUsersById($_id);
        

        $router->renderView('users/index', [
            'user' => $user
        ]);

        
        $logger->log('Accsess to /users','INFO',$_SESSION['username'],$_SESSION['role']);
    }
    public static function create(Router $router)
    {
        $logger = New Logger;
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
                $logger->log('Successful register process','INFO',$userData['username'],'user');
                header('Location: /users/login');
                exit;
            }

        }
        $router->renderView('users/register', [
            'user' => $userData,
            'errors' => $errors
        ]);
        $logger->log('Accsess to /users/register','INFO','0','0');
    }
    public static function login(Router $router)
    {
        $logger = New Logger;
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
                $logger->log('Successful login process','NOTICE',$userData['username'],$_SESSION['role']);
                header('Location: /users');
                exit;
            }else{
                $logger->log('Failed login process','WARNING',$userData['username'],'0');
            }

        }
        $router->renderView('users/login', [
            'user' => $userData,
            'errors' => $errors
        ]);
        $logger->log('Access to /users/login','INFO','0','0');
    }
    public static function logout(){
        $authentication= new Authentication;
        $logger = New Logger;
        $logger->log('Logged out','INFO',$_SESSION['username'],$_SESSION['role']);
        $authentication->logout();
        header('Location: /');
        exit;
      
        
    }
    public static function updateUserCategories(Router $router){
        $logger = New Logger;
        $_id = Authentication::getUserSessionInfo('_id');
        $oldData = $router->db->getUserCategories($_id);
        $userData = [];
        $success= "";

        foreach ($oldData as $data){
            foreach ($data as $key => $val){
                if ($val == 1){
                    $userData[]= $key;
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $userData = [];
            if (isset($_POST['science'])){
                $userData[]= 'science';
            }
            if (isset($_POST['health'])){
                $userData[]= 'health';
            }
            if (isset($_POST['political'])){
                $userData[]= 'political';
            }
            if (isset($_POST['technology'])){
                $userData[]= 'technology';
            }
            if (isset($_POST['world'])){
                $userData[]= 'world';
            }
            if (isset($_POST['economy'])){
                $userData[]= 'economy';
            }
            if (isset($_POST['sports'])){
                $userData[]= 'sports';
            }
            if (isset($_POST['art'])){
                $userData[]= 'art';
            }
            if (isset($_POST['education'])){
                $userData[]= 'education';
            }
            if (isset($_POST['social'])){
                $userData[]= 'social';
            }
            $user= new User();
            $user->loadCategoryInfo($_id,$userData);
            $user->updateCategories();
            $logger->log('Updated user categories','INFO',$_SESSION['username'],$_SESSION['role']);
            $success= 1;
            
        }

        $router->renderView('users/update_category', [
            'user' => $userData,
            'success' => $success
        ]);
        $logger->log('Access to users/category','INFO',$_SESSION['username'],$_SESSION['role']);
    }

    public static function getuserComments(Router $router)
    {
        $logger = New Logger;
        $_id= Authentication::getUserSessionInfo('_id');
        $search = $_GET['search'] ?? '';
        $warning = "";
        $comments= $router->db->getCommentsByUserId($_id,$search);
        $comments_count = count($router->db->getCommentsByUserId($_id));
        
        if (!$comments_count){
            $warning = 1;
        }
        if ($search){
            $logger->log("Search attempt for /users/comments: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }


        $router->renderView('users/comments', [
            'comments' => $comments,
            'comments_count' => $comments_count,
            'warning' => $warning,
            'search' => $search
        ]);
        $logger->log('Access to users/comments','INFO',$_SESSION['username'],$_SESSION['role']);
    }

    public static function getUserNewsRead(Router $router)
    {
        $logger = New Logger;
        $_id= Authentication::getUserSessionInfo('_id');
        $search = $_GET['search'] ?? '';
        $warning = "";
        $news= $router->db->getUserNewsRead($_id,$search);
        $newsCount= count($router->db->getUserNewsRead($_id));
        if (!$newsCount){
            $warning = 1;
        }
        if ($search){
            $logger->log("Search attempt for /users/newsread: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $router->renderView('users/news_read', [
            'news' => $news,
            'search' => $search,
            'newsCount' => $newsCount,
            'warning' => $warning
        ]);
        $logger->log('Access to users/newsread','INFO',$_SESSION['username'],$_SESSION['role']);
    }

    
    public static function deleteUser(Router $router)
    {
        $logger = New Logger;
        if (isset($_POST['delete'])){
            $auth = new Authentication;
            $_id= $auth->getUserSessionInfo('_id');
            $logger->log('Deleted their account','NOTICE',$_SESSION['username'],$_SESSION['role']);
            $router->db->deleteUser($_id,true);
            $auth->logout();
            header("location: /");
        }
        
    }

}