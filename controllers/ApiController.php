<?php

namespace app\controllers;

use app\Router;

class ApiController
{
    public static function apiAll(Router $router)
    {
        $news=$router->db->getNews("",false,true);

        if ($news){
            $news = json_encode($news,JSON_PRETTY_PRINT);
        }else{
            $news = "404";
        }

        $router->renderView('api/index', [
            'news' => $news,
        ], true);
    }

    public static function apiOne(Router $router)
    {
        $_id = $_GET['_id'] ?? '';
        if (!$_id){
            header('Location: /news/api');
            exit;
        }
        $news=$router->db->getNewsById($_id,false,true);
        if ($news){
            $news= json_encode($news,JSON_PRETTY_PRINT);
        }else{
            $news = "404";
        }
    
        $router->renderView('api/index', [
            'news' => $news,
        ], true);
    }
}