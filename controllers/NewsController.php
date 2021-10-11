<?php

namespace app\controllers;

use app\Router;
use app\Database;
use app\models\News;
use app\models\Comments;
use app\Authentication;
use DateTime;
use app\Logger\Logger;

class NewsController
{
    public static function index(Router $router)
    {
        $logger = New Logger;
        $search = $_GET['search'] ?? '';

        if ($search){
            $logger->log("Search attempt for /news: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $news=$router->db->getNews($search);
        $router->renderView('news/index', [
            'news' => $news,
            'search' => $search
        ]);
        $logger->log('Access to /news','INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
    }

    public static function viewNewsWithCategory(Router $router)
    {
        $logger = New Logger;
        $search= $_GET['search'] ?? '';
        $url= $_SERVER['PATH_INFO'];
        $url= substr($url,6);

        if ($search){
            $logger->log("Search attempt for /news/$url: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $news = $router->db->getNewsWithCategory($url,$search);
        $viewTitle= ucfirst($url);
        $router->renderView('news/by_category', [
            'news' => $news,
            'search' => $search,
            'viewTitle' => $viewTitle
        ]);
        $logger->log("Access to /news/$url",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
        
    }
    public static function viewNewsForUser(Router $router)
    {
        $logger = New Logger;
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

            if ($search){
                $logger->log("Search attempt for /news/forme: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
            }

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
        $logger->log("Access to /users/mynews",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
    }


    public static function viewSpesificNews(Router $router)
    {
        $logger = New Logger;
        $db= Database::$db;
        $news_id = $_GET['_id'] ?? null;
        if (!$news_id){
            header('Location: /news');
            exit;
        }
        $news= $db->getNewsById($news_id);

        if (!$news){
            $logger->log("Tried to access a news that doesn't exist (with id: $news_id)",'NOTICE',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
            header('Location: /news');
            exit;
        }
        $logger->log("Access to /news/spesific?_id=$news_id",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");

        if (isset($_SESSION['_id'])){
            $users_id= $_SESSION['_id'];
            if (!$db->checkUserNewsRead($users_id,$news_id)){
                $db->setUserNewsRead($users_id,$news_id);
                $logger->log("Read /news/spesific?_id=$news_id for the first time",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
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
             $logger->log("Created a comment for /news/spesific?_id=$news_id",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
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
        $logger = New Logger;
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
                $logger->log("Created news with the Title: ".$newsData['title']."",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
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
        $logger->log("Access to /mod/createnews",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
    }

    public static function update(Router $router) ///Mod/Admin
    {
        $logger = New Logger;
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
                    $date = date('Y-m-d H:i:s');
                    $router->db->deleteNews($id,$date,true);
                    $logger->log("Deleted News with id: ".$id."",'NOTICE',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
                }
            }elseif(isset($_POST['restore'])){
                if ($newsData['isDeleted']){
                    $router->db->restoreNewsById($id,true);
                    $logger->log("Restored News with id: ".$id."",'NOTICE',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
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
                $logger->log("Updated News with id: ".$id."",'NOTICE',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
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
        $logger->log("Access to /mod/editnews",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
    }

    public static function about(Router $router)
    {
        $logger = new Logger;
        $router->renderView('news/about');
        $logger->log("Access to /about page",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
    }

    public static function editorCreate(Router $router)
    {
        $logger = new Logger;
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
                $logger->log("Created news with Title: ".$newsData['title']."",'NOTICE',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
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
        $logger->log("Access to /editor/createnews",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
    }
    public static function editorUpdate(Router $router)
    {
        $logger = new Logger;
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
                        $logger->log("Updated news with id: ".$news_id."",'NOTICE',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
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
        $logger->log("Access to /editor/updatenews",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
    }
    public static function maintenance(Router $router)
    {
        $logger = new Logger();
        $message= "We are at maintenance to provide better service, please visit us later. Thank you for your patience.";
        $router->renderView('maintenance/index', [
            'message' => $message
        ],false,true);
        $logger->log("Tried to access website during maintenance",'INFO',$_SESSION['username'] ?? "0",$_SESSION['role'] ?? "0");
    }
}