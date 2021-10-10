<?php

namespace app\controllers;

use app\Router;

class AdminController


{
    public static function index(Router $router)
    {
        $router->renderView('admin/index', [
        ]);
        
    }
    public static function activities(Router $router)
    {
        $router->renderView('admin/activities', [
        ]);
        
    }
    public static function users(Router $router)
    {
        $search = $_GET['search'] ?? "";
        $users = $router->db->getUsers($search);
        $users_count = count($router->db->getUsers());

        $router->renderView('admin/users', [
            'users' => $users,
            'search' => $search,
            'count' => $users_count
        ]);
        
    }
    public static function promote(Router $router)
    {
        $_id = $_GET['_id'] ?? "";
        $user = $router->db->getUsersById($_id);
        $warning = 0;

        if (!$_id){
            $warning = 1;
        }

        if ($user){
            $role = $user['role'];
            
            if (isset($_POST['user'])){
                if($role != 'user' || $role != 'admin'){
                    $router->db->setUserRoleById($_id,'user');
                    header("refresh:0");
                }
                
            }elseif (isset($_POST['editor'])){
                if($role != 'editor' || $role != 'admin'){
                    $router->db->setUserRoleById($_id,'editor');
                    header("refresh:0");
                }
            }elseif (isset($_POST['mod'])){
                if($role != 'mod' || $role != 'admin'){
                    $router->db->setUserRoleById($_id,'mod');
                    header("refresh:0");
                }
            }elseif (isset($_POST['admin'])){
                if($role != 'admin'){
                    $router->db->setUserRoleById($_id,'admin');
                    header("refresh:0");
                }
            }
        }
        $router->renderView('admin/promote_user', [
            'id' => $_id,
            'user' => $user,
            'warning' => $warning
        ]);
        
    }


}