<?php

namespace app\controllers;

use app\Router;
use app\Logger\Logger;

class ApiController
{
    public static function api(Router $router)
    {
        $logger = new Logger;
        $_id = $_GET['id'] ?? '';
        if ($_id){
            $news=$router->db->getNewsById($_id,false,true);
            if ($news){
                $news= json_encode($news,JSON_PRETTY_PRINT);
                $logger->log("Access to /api/news with id: $_id",'INFO',$_SESSION['username'],$_SESSION['role']);
            }else{
                $news = "404";
                $logger->log("Tried to access a news api that doesn't exist (with id: $_id)",'INFO',$_SESSION['username'],$_SESSION['role']);
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
        $logger->log('Access to /api/news','INFO',$_SESSION['username'],$_SESSION['role']);
    
    }
}