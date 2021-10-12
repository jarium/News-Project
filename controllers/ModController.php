<?php

namespace app\controllers;

use app\Router;
use app\models\Comments;
use app\Logger\Logger;

class ModController


{
    public static function index(Router $router)
    {
        $logger = New Logger;
        $router->renderView('mod/index', [
        ]);
        $logger->log('Access to /mod','INFO',$_SESSION['username'],$_SESSION['role']);
    }

    public static function manageNews(Router $router)
    {
        $logger = New Logger;
        $search = $_GET['search'] ?? '';

        if ($search){
            $logger->log("Search attempt for /mod/news: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $news=$router->db->getNews($search,true);
        $count = count($router->db->getNews("",true));
        
        $router->renderView('mod/news', [
            'news' => $news,
            'search' => $search,
            'count' => $count,
        ]);
        $logger->log('Access to /mod/news','INFO',$_SESSION['username'],$_SESSION['role']);
        
    }


    public static function updateEditorCategories(Router $router)
    {
        $logger = New Logger;
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
                $logger->log("Updated editor categories with id: $_id",'NOTICE',$_SESSION['username'],$_SESSION['role']);
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
        $logger->log('Access to /mod/editorcategory','INFO',$_SESSION['username'],$_SESSION['role']);
    }

    public static function promote(Router $router)
    {
        $logger = new Logger;
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
                    $router->db->setUserRoleById($_id,'editor','user');
                    $logger->log("Demoted editor to user with id: $_id",'NOTICE',$_SESSION['username'],$_SESSION['role']);
                    header("refresh:0");
                }
                
            }elseif (isset($_POST['editor'])){
                if($role == 'user'){
                    $router->db->setUserRoleById($_id,'user','editor',$username);
                    $logger->log("Promoted user to editor with id: $_id",'NOTICE',$_SESSION['username'],$_SESSION['role']);
                    header("refresh:0");
                }
            }
        }
        $router->renderView('mod/promote_user', [
            'id' => $_id,
            'user' => $user,
            'warning' => $warning
        ]);
        $logger->log("Access to mod/promote",'INFO',$_SESSION['username'],$_SESSION['role']);

    }
    public static function usersAndEditors(Router $router)
    {
        $logger = new Logger;
        $search = $_GET['search'] ?? "";

        if ($search){
            $logger->log("Search attempt for /mod/showusers: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $users = $router->db->getAllEditorUsers($search);
        $count = count($router->db->getAllEditorUsers());
        $router->renderView('mod/users', [
            'users' => $users,
            'search' => $search,
            'count' => $count
        ]);
        $logger->log("Access to /mod/showusers",'INFO',$_SESSION['username'],$_SESSION['role']);
    }

    public static function manageComments(Router $router)
    {
        $logger = new Logger;
        $search = $_GET['search'] ?? "";

        if ($search){
            $logger->log("Search attempt for /mod/comments: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $comments = $router->db->getAllComments($search);
        $comments_count = count($router->db->getAllComments());
        
        $router->renderView('mod/comments', [
            'comments' => $comments,
            'search' => $search,
            'comments_count' => $comments_count
        ]);
        $logger->log("Access to mod/comments",'INFO',$_SESSION['username'],$_SESSION['role']);

    }
    public static function updateComments(Router $router)
    {
        $logger = new Logger;
        $_id = $_GET['_id'] ?? "";
        $comment = $router->db->getCommentsById($_id);
        $warning = 0;
        $errors = [];
        $commentData = [
            "_id" => "",
            "comment" => "",
            "update_date" => ""
        ];

        if (!$_id){
            $warning = 1;
        }

        if ($comment && $_SERVER['REQUEST_METHOD'] === 'POST'){

            if (isset($_POST['delete'])){
                if (!$comment['isDeleted']){
                    $router->db->deleteCommentsById($_id);
                    $logger->log("Deleted comment with id: $_id",'NOTICE',$_SESSION['username'],$_SESSION['role']);
                }
                
            }elseif (isset($_POST['restore'])){
                if ($comment['isDeleted']){
                    $router->db->restoreCommentsById($_id);
                    $logger->log("Restored comment with id: $_id",'NOTICE',$_SESSION['username'],$_SESSION['role']);
                }
            }else{
                $commentData['_id'] = $_id;
                $commentData['update_date']= date('Y-m-d H:i:s');
                $commentData['comment']= $_POST['comment'];
                $add_comments= new Comments();
                $add_comments->load($commentData);
                $errors= $add_comments->save();
            }
            if (empty($errors)){
             $logger->log("Updated comment with id: $_id",'NOTICE',$_SESSION['username'],$_SESSION['role']);
             header("Refresh:0");
             exit;
            }
        }

        $router->renderView('mod/update_comment', [
            'id' => $_id,
            'comment' => $comment,
            'warning' => $warning,
            'errors' => $errors
        ]);
        $logger->log("Access to /mod/editcomment",'INFO',$_SESSION['username'],$_SESSION['role']);

    }

    public static function deletedUsers(Router $router)
    {
        $logger = new Logger;
        $search = $_GET['search'] ?? "";

        if ($search){
            $logger->log("Search attempt for /mod/deleted_users: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $users = $router->db->getDeletedUsers($search);
        $count = count($router->db->getDeletedUsers());

        $router->renderView('mod/deleted_users', [
            'users' => $users,
            'search' => $search,
            'count' => $count
        ]);
        $logger->log("Access to /mod/deletedusers",'INFO',$_SESSION['username'],$_SESSION['role']);

    }
    public static function activities (Router $router)
    {
        $logger = new Logger;
        $dateNow = date('Y-m-d');
        $log = "";
        $date = $_GET['date'] ?? $dateNow;
        if (file_exists("../Logs/Mod/$date".".log")){
            $log = file_get_contents("../Logs/Mod/$date".".log");
            $logger->log("Access to /mod/activities with date: $date",'INFO',$_SESSION['username'],$_SESSION['role']);
        }else{
            $logger->log("Tried to access an activity date from /mod/acitvities that doesn't exist (date: $date)",'INFO',$_SESSION['username'],$_SESSION['role']);
        }
    

        $router->renderView('mod/activities', [
            'log' => $log,
            'date' => $date,
            'dateNow' => $dateNow
        ]);
    }
}