<?php

namespace app\controllers;

use app\Router;

class ApiController
{
    public static function api(Router $router)
    { $_id = $_GET['id'] ?? '';
        if ($_id){
            $news=$router->db->getNewsById($_id,false,true);
            if ($news){
                $news= json_encode($news,JSON_PRETTY_PRINT);
            }else{
                $news = "404";
            }

        }else{
            $news=$router->db->getNews("",false,true);
            if ($news){
                $news = json_encode($news,JSON_PRETTY_PRINT);
            }else{
                $news = "404";
            }
        }
        $router->renderView('api/index', [
            'news' => $news,
        ], true);
    }
}