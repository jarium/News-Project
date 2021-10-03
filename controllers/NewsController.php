<?php

namespace app\controllers;

use app\Router;
use app\Database;
use app\models\News;
use app\models\Comments;

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

    public static function viewSpesificNews(Router $router)
    {
        $db= Database::$db;
        $_id = $_GET['_id'] ?? null;
        if (!$_id){
            header('Location: /news');
            exit;
        }
        $news= $db->getNewsById($_id);

        if (!$news){
            header('Location: /news');
            exit;
        }
        $newsData = [
            '_id' => "",
            'image' => "",
            'title' => "",
            'content' => "",
            'author_username' => "",
            'category' => "",
            'create_date' => "",
            'update_date' => "",
        ];

        $comments = $db->getComments($_id);
        $newsData['_id'] = $news['_id'];
        $newsData['image']= $news['image'];
        $newsData['title']= $news['title'];
        $newsData['content']= $news['content'];
        $newsData['author_username']= $news['author_username'];
        $newsData['category']= $news['category'];
        $newsData['create_date']= $news['create_date'];
        $newsData['update_date']= $news['update_date'];

            
        $errors = [];
        $commentData = [
            'news_id' => "",
            'commenter_id' => "",
            'commenter_username' => "",
            'comment' => "",
            'isAnon' => 0,
             ];

         //Create comment    
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
        }//Create comment end
        $router->renderView("news/spesific_news", [
            'news' => $newsData,
            'comments' => $comments,
            'add_comments' => $commentData
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
}