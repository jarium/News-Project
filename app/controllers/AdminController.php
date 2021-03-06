<?php

namespace app\controllers;

use app\Logger\Logger;
use app\Router;

class AdminController


{
    public static function index(Router $router)
    {
        $logger = new Logger;
        $router->renderView('admin/index', [
        ]);
        $logger->log("Access to /admin",'INFO',$_SESSION['username'],$_SESSION['role']);
        
    }
    public static function activities(Router $router)
    {
        $logger = new Logger;
        $dateNow = date('Y-m-d');
        $log = "";
        $date = $_GET['date'] ?? $dateNow;
        
        if(preg_match("/[a-z]/i", $date) || str_contains($date,'.') || str_contains($date,'/') ){
            $date = $dateNow;
        }
        $date = htmlspecialchars($date);

        if (file_exists("../Logs/Admin/$date".".log")){
            $log = file_get_contents("../Logs/Admin/$date".".log");
            $logger->log("Access to /admin/activities with date: $date",'INFO',$_SESSION['username'],$_SESSION['role']);
        }else{
            $logger->log("Tried to access an activity date from /admin/acitvities that doesn't exist (date: $date)",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $router->renderView('admin/activities', [
            'log' => $log,
            'date' => $date,
            'dateNow' => $dateNow
        ]);
        
    }
    public static function users(Router $router)
    {
        $logger = new Logger;
        $search = $_GET['search'] ?? "";

        if ($search){
            $search = htmlspecialchars($search);
            $logger->log("Search attempt for /admin/users: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $users = $router->db->getUsers($search);
        $users_count = count($router->db->getUsers());

        $router->renderView('admin/users', [
            'users' => $users,
            'search' => $search,
            'count' => $users_count
        ]);
        $logger->log("Access to /admin/users",'INFO',$_SESSION['username'],$_SESSION['role']);
        
    }
    public static function promote(Router $router)
    {
        $logger = new Logger;
        $_id = $_GET['_id'] ?? "";
        
        if (!$_id){
            $warning = 1;
        }else{
            $_id = htmlspecialchars($_id);
        }

        $user = $router->db->getUsersById($_id);
        $warning = 0;

        if ($user){
            $role = $user['role'];
            
            if (isset($_POST['user'])){
                if($role != 'user' || $role != 'admin'){
                    $router->db->setUserRoleById($_id,$user['role'],'user');
                    $logger->log("Demoted user from [$role] to -> [user] with id: $_id ",'NOTICE',$_SESSION['username'],$_SESSION['role']);
                    header("refresh:0");
                }
                
            }elseif (isset($_POST['editor'])){
                if($role != 'editor' || $role != 'admin'){
                    $router->db->setUserRoleById($_id,$user['role'],'editor',$user['username']);
                    $logger->log("Set user role from [$role] to -> [editor] with id: $_id ",'NOTICE',$_SESSION['username'],$_SESSION['role']);
                    header("refresh:0");
                }
            }elseif (isset($_POST['mod'])){
                if($role != 'mod' || $role != 'admin'){
                    $router->db->setUserRoleById($_id,$user['role'],'mod');
                    $logger->log("Promoted user from [$role] to -> [mod] with id: $_id ",'NOTICE',$_SESSION['username'],$_SESSION['role']);
                    header("refresh:0");
                }
            }elseif (isset($_POST['admin'])){
                if($role != 'admin'){
                    $router->db->setUserRoleById($_id,$user['role'],'admin');
                    $logger->log("Promoted user from [$role] to -> [admin] with id: $_id ",'NOTICE',$_SESSION['username'],$_SESSION['role']);
                    header("refresh:0");
                }
            }
        }
        $router->renderView('admin/promote_user', [
            'id' => $_id,
            'user' => $user,
            'warning' => $warning
        ]);
        $logger->log("Access to /admin/promote",'INFO',$_SESSION['username'],$_SESSION['role']);   
    }
}