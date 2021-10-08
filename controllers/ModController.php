<?php

namespace app\controllers;

use app\Router;

class ModController


{
    public static function index(Router $router){
        $router->renderView('mod/index', [
        ]);
        
    }

    public static function updateEditorCategories(Router $router){
        $_id = $_GET['_id'] ?? "";
        $user = $router->db->getUsersbyIdRole($_id,'editor');
        $editorData=[];
        $success= 0;
        $warning = 0;

        if (!$_id){
            $warning = 1;
        }

        if ($user){
            $oldData = $router->db->getEditorCategories($_id);

            foreach ($oldData as $data){
                foreach ($data as $key => $val){
                    if ($val == 1){
                        $editorData[]= $key;
                    }
                }
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $editorData = [];
                if (isset($_POST['science'])){
                    $editorData[]= 'science';
                }
                if (isset($_POST['health'])){
                    $editorData[]= 'health';
                }
                if (isset($_POST['political'])){
                    $editorData[]= 'political';
                }
                if (isset($_POST['technology'])){
                    $editorData[]= 'technology';
                }
                if (isset($_POST['world'])){
                    $editorData[]= 'world';
                }
                if (isset($_POST['economy'])){
                    $editorData[]= 'economy';
                }
                if (isset($_POST['sports'])){
                    $editorData[]= 'sports';
                }
                if (isset($_POST['art'])){
                    $editorData[]= 'art';
                }
                if (isset($_POST['education'])){
                    $editorData[]= 'education';
                }
                if (isset($_POST['social'])){
                    $editorData[]= 'social';
                }
                
                $sql = "";
                $categoryNames= ['science','health','political','technology','world','economy','sports','art','education','social'];
                $newCategories= $editorData;
        
                $oldCategories= array_diff($categoryNames,$newCategories);

                $sql = "";
                foreach ($oldCategories as $oldCategory){
                $sql .="$oldCategory = '0', ";
                }
                foreach ($newCategories as $newCategory){
                    $sql .="$newCategory = '1', ";
                }      
                $sql = substr_replace($sql,"",-2);

                $router->db->updateEditorCategories($_id, $sql);
                $success= 1;
            }
        }
        $router->renderView('mod/update_editor', [
            'id' => $_id,
            'categories' => $editorData,
            'editor' => $user,
            'success' => $success,
            'warning' => $warning
        ]);
    }

    public static function promote(Router $router)
    {
        $_id = $_GET['_id'] ?? "";
        $user = $router->db->getUsersEditorsById($_id);
        $warning = 0;

        if (!$_id){
            $warning = 1;
        }

        if ($user){
            $username = $user['username'];
            $role = $user['role'];
            
            if (isset($_POST['user'])){
                if($role == 'editor'){
                    $router->db->setEditorById($_id,'user',false,"");
                    header("refresh:0");
                }
                
            }elseif (isset($_POST['editor'])){
                if($role == 'user'){
                    $router->db->setEditorById($_id,'editor',true,$username);
                    header("refresh:0");
                }
            }
        }
        $router->renderView('mod/promote_user', [
            'id' => $_id,
            'user' => $user,
            'warning' => $warning
        ]);

    }
    public static function usersAndEditors(Router $router)
    {
        $search = $_GET['search'] ?? "";
        $users = $router->db->getAllEditorUsers($search);

        $router->renderView('mod/users', [
            'users' => $users,
            'search' => $search
        ]);
    }
}