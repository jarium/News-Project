<?php

namespace app\controllers;

use app\Router;
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

    public static function create(Router $router)
    {
        $errors = [];
        $newsData = [
            'title' => "",
            'author_username' => "",
            'content' => "",
            'image' => "",
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $newsData['title'] = $_POST['title'];
            $newsData['description'] = $_POST['description'];
            $newsData['author'] = $_SESSION['user'];
            $newsData['imageFile'] = $_FILES['image'];

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
        $id = $_GET['id'] ?? null;
        if (!$id){
            header('Location: /news');
            exit;
        }
        $errors= [];
        $newsData = $router->db->getNewsById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $newsData['title'] = $_POST['title'];
            $newsData['description'] = $_POST['description'];
            $newsData['price'] = (float)$_POST['price'];
            $newsData['imageFile'] = $_FILES['image'] ?? null;

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
        $id = $_POST['id'] ?? null;
        if (!$id){
            header('Location: /news');
            exit;
        } 
        $router->db->deleteNews($id);
        header('Location: /news');
        exit;
    }
}