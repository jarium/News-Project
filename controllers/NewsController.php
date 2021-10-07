<?php

namespace app\controllers;

use app\Router;
use app\Database;
use app\models\News;
use app\models\Comments;
use app\Authentication;

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

        //Create comment 
        $comments = $db->getComments($news_id);
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
            $commentData['newsTitle'] = $news['title'];
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
        }//Create comment end

        $comments_count = count($comments);
        $router->renderView("news/spesific_news", [
            'news' => $news,
            'comments' => $comments,
            'comments_count' => $comments_count,
            'add_comments' => $commentData,
            'errors' => $errors
        ]);
    }

    public static function create(Router $router)
    {
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
                header('Location: /news');
                exit;
            }

        }
        $router->renderView('news/create', [
            'news' => $newsData,
            'errors' => $errors
        ]);
    }

    public static function update(Router $router)
    {
        $id = $_GET['_id'] ?? null;
        if (!$id){
            header('Location: /news');
            exit;
        }
        $errors= [];
        $newsData = $router->db->getNewsById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $newsData['title'] = $_POST['title'];
            $newsData['content'] = $_POST['content'];
            $newsData['author'] = $_SESSION['username'];
            $newsData['author_id'] = $_SESSION['_id'];
            $newsData['imageFile'] = $_FILES['image'];
            $newsData['category'] = $_POST['category'];

            $news = new News();
            $news->load($newsData);
            $errors= $news->save();
            if (empty($errors)){
                header('Location: /news');
                exit;
            }
        }

        $router->renderView('news/update', [
            'news' => $newsData,
            'errors' => $errors
        ]);
    }

    public static function delete(Router $router)
    {
        $id = $_POST['_id'] ?? null;
        if (!$id){
            header('Location: /news');
            exit;
        } 
        $router->db->deleteNews($id);
        header('Location: /news');
        exit;
    }

    public static function about(Router $router)
    {
        $router->renderView('news/about');
    }
}