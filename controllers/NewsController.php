<?php

namespace app\controllers;

use app\Router;
use app\Database;
use app\models\News;

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

    public function viewSpesificNews(Router $router)
    {
        $db= Database::$db;
        $_id = $_GET['_id'] ?? null;
        if (!$_id){
            header('Location: /news');
            exit;
        }
        $newsData = [
            'image' => "",
            'title' => "",
            'content' => "",
            'author' => "",
            'category' => "",
        ];
        $news= $db->getNewsById($_id);
        $newsData['image']= $news['image'];
        $newsData['title']= $news['title'];
        $newsData['content']= $news['content'];
        $newsData['author']= $news['author'];
        $newsData['category']= $news['category'];
        
        if ($news){
            $router->renderView("news/spesific_news", [
                'news' => $newsData,
            ]);
        }
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