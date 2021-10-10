<?php

namespace app\controllers;

use app\Router;
use app\Database;
use app\models\News;
use app\models\Comments;
use app\Authentication;
use DateTime;

class NewsController
{
    public static function index(Router $router)
    {
        $search = $_GET['search'] ?? '';
        $news=$router->db->getNews($search);
        $router->renderView('news/index', [
            'news' => $news,
            'search' => $search
        ]);
    }

    public static function viewNewsWithCategory(Router $router)
    {
        $search= $_GET['search'] ?? '';
        $url= $_SERVER['PATH_INFO'];
        $url= substr($url,6);
        $news = $router->db->getNewsWithCategory($url,$search);
        $viewTitle= ucfirst($url);
        $router->renderView('news/by_category', [
            'news' => $news,
            'search' => $search,
            'viewTitle' => $viewTitle
        ]);
        
    }
    public static function viewNewsForUser(Router $router)
    {
        $_id = Authentication::getUserSessionInfo('_id');
        $categories= $router->db->getUserCategories($_id);
        $user_categories= [];
        foreach($categories as $category){
            foreach($category as $val => $v ){
                if ($v == 1){
                    $user_categories[]= $val;
                }
            }
        }
        $warning = "";
        if (!empty($user_categories)){
            $sql= "(";
            $search = $_GET['search'] ?? '';

            foreach ($user_categories as $category){
                $category= $category."'"; 
                $category= "'".$category;
                $sql.="$category, ";
            }
            $sql= substr_replace($sql,"",-2);
            $sql.= ")";
    
            $news= $router->db->getNewsForUser($sql,$search);

        }else{
            $news= "";
            $search = "";
            $warning = "1";
        }

        $router->renderView('news/for_user', [
            'news' => $news,
            'search' => $search,
            'warning' => $warning
        ]);
        
    }


    public static function viewSpesificNews(Router $router)
    {
        $db= Database::$db;
        $news_id = $_GET['_id'] ?? null;
        if (!$news_id){
            header('Location: /news');
            exit;
        }
        $news= $db->getNewsById($news_id);

        if (!$news){
            header('Location: /news');
            exit;
        }

        if (isset($_SESSION['_id'])){
            $users_id= $_SESSION['_id'];
            if (!$db->checkUserNewsRead($users_id,$news_id)){
                $db->setUserNewsRead($users_id,$news_id);
            }
        }
        //Show comments
        $comments = $db->getComments($news_id);

        //Create comment 
        $errors = [];
        $commentData = [
            'news_id' => "",
            'commenter_id' => "",
            'commenter_username' => "",
            'comment' => "",
            'isAnon' => 0,
             ];
               
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $commentData['news_id']= $news['_id'];
            $commentData['commenter_id']= $_SESSION['_id'];
            $commentData['commenter_username']= $_SESSION['username'];
            $commentData['comment']= $_POST['comment'];
            if (isset($_POST['isAnon'])){
                $commentData['isAnon']=1;
            }

            $add_comments= new Comments();
            $add_comments->load($commentData);
            $errors= $add_comments->save();
            if (empty($errors)){
             header("Refresh:0");
             exit;
            }
        }
        //Create comment end

        $comments_count = count($comments);
        $router->renderView("news/spesific_news", [
            'news' => $news,
            'comments' => $comments,
            'comments_count' => $comments_count,
            'add_comments' => $commentData,
            'errors' => $errors
        ]);
    }

    public static function create(Router $router) //Admin,Mod
    {
        $success = 0;
        $errors = [];
        $newsData = [
            'title' => "",
            'author' => "",
            'author_id' => "",
            'content' => "",
            'image' => "",
            'category' => "",
        ];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $newsData['title'] = $_POST['title'];
            $newsData['content'] = $_POST['content'];
            $newsData['author'] = $_SESSION['username'];
            $newsData['author_id'] = $_SESSION['_id'];
            $newsData['imageFile'] = $_FILES['image'];
            $newsData['category'] = $_POST['category'];

            $news= new News();
            $news->load($newsData);
            $errors= $news->save();
            if (empty($errors)){
                $success= 1;
                $newsData = [
                    'title' => "",
                    'author' => "",
                    'author_id' => "",
                    'content' => "",
                    'image' => "",
                    'category' => "",
                ];
            }

        }
        $router->renderView('news/create', [
            'news' => $newsData,
            'errors' => $errors,
            'success' => $success
        ]);
    }

    public static function update(Router $router) ///Mod/Admin
    {
        $id = $_GET['_id'] ?? null;
        $warning = 0;
        $success = 0;
        $errors= [];
        $newsData = $router->db->getNewsById($id,true);

        if (!$id){
            $warning = 1;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['delete'])){
                if (!$newsData['isDeleted']){
                    $router->db->deleteNews($id,true);
                }
            }elseif(isset($_POST['restore'])){
                if ($newsData['isDeleted']){
                    $router->db->restoreNewsById($id,true);
                }
            }else{
                $newsData['title'] = $_POST['title'];
                $newsData['content'] = $_POST['content'];
                $newsData['author'] = $_SESSION['username'];
                $newsData['author_id'] = $_SESSION['_id'];
                $newsData['imageFile'] = $_FILES['image'];
                $newsData['category'] = $_POST['category'];
                $news = new News();
                $news->load($newsData);
                $errors= $news->save();
            }

            if (empty($errors)){
                $success = 1;
                $newsData = $router->db->getNewsById($id,true);
            }
        }

        $router->renderView('mod/update_news', [
            'news' => $newsData,
            'errors' => $errors,
            'id' => $id,
            'warning' => $warning,
            'success' => $success
        ]);
    }

    public static function about(Router $router)
    {
        $router->renderView('news/about');
    }

    public static function editorCreate(Router $router)
    {
        $_id = Authentication::getUserSessionInfo('_id');
        $success = 0;
        $editor_categories = $router->db->getEditorCategories($_id);
        $categories= [];

        
        foreach ($editor_categories as $data){
            foreach ($data as $key => $val){
                if ($val == 1){
                    $categories[]= ucfirst($key);
                }
            }
        }

        $errors = [];
        $newsData = [
            'title' => "",
            'author' => "",
            'author_id' => "",
            'content' => "",
            'image' => "",
            'category' => "",
        ];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $newsData['title'] = $_POST['title'];
            $newsData['content'] = $_POST['content'];
            $newsData['author'] = $_SESSION['username'];
            $newsData['author_id'] = $_SESSION['_id'];
            $newsData['imageFile'] = $_FILES['image'];
            $newsData['category'] = $_POST['category'];

            $news= new News();
            $news->load($newsData);
            $errors= $news->save($categories);
            if (empty($errors)){
                $success= 1;
                $newsData = [
                    'title' => "",
                    'author' => "",
                    'author_id' => "",
                    'content' => "",
                    'image' => "",
                    'category' => "",
                ];
            }

        }
        $router->renderView('news/create', [
            'news' => $newsData,
            'errors' => $errors,
            'success' => $success,
            'categories' => $categories
        ]);
    }
    public static function editorUpdate(Router $router)
    {
        $editor_id= Authentication::getUserSessionInfo('_id');
        $editor_categories = $router->db->getEditorCategories($editor_id);

        $categories= [];

        
        foreach ($editor_categories as $data){
            foreach ($data as $key => $val){
                if ($val == 1){
                    $categories[]= ucfirst($key);
                }
            }
        }

        $news_id = $_GET['_id'] ?? null;
        $warning = 0;
        $success = 0;
        $timeout = 0;
        $errors= [];
        
        $newsData = $router->db->getEditorNewsById($editor_id,$news_id);

        if (!$news_id){
            $warning = 1;
        }

        if ($newsData){
            
            $datetime1 = new DateTime();
            $datetime2 = new DateTime($newsData['create_date']);
            $interval = $datetime1->diff($datetime2);
            $year = $interval->format('%y');
            $month= $interval->format('%m');
            $day= $interval->format('%d');

            if ($year >= 1 || $month >= 1 || $day >= 1){
                $timeout = 1;
            }else{
                if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $newsData['title'] = $_POST['title'];
                    $newsData['content'] = $_POST['content'];
                    $newsData['author'] = $_SESSION['username'];
                    $newsData['author_id'] = $_SESSION['_id'];
                    $newsData['imageFile'] = $_FILES['image'];
                    $newsData['category'] = $_POST['category'];
                
                    $news = new News();
                    $news->load($newsData);
                    $errors= $news->save($categories);

                    if (empty($errors)){
                        $success = 1;
                        $newsData = $router->db->getEditorNewsById($editor_id,$news_id);
                    }
                }
            }
        }
        $router->renderView('editor/update_news', [
            'id' => $news_id,
            'news' => $newsData,
            'errors' => $errors,
            'success' => $success,
            'categories' => $categories,
            'warning' => $warning,
            'timeout' => $timeout
        ]);
    }
}