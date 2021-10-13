<?php

namespace app\controllers;

use app\Router;
use app\Authentication;
use app\Logger\Logger;

class EditorController
{
    public static function index(Router $router){
        $logger = new Logger;
        $router->renderView('editor/index', [
        ]);
        $logger->log('Access to /editor','INFO',$_SESSION['username'],$_SESSION['role']);
        
    }

    public static function editorNews(Router $router)
    {
        $logger = new Logger;
        $_id = Authentication::getUserSessionInfo('_id');
        $search = $_GET['search'] ?? '';

        if ($search){
            $logger->log("Search attempt for /editor/mynews: $search",'INFO',$_SESSION['username'],$_SESSION['role']);
        }

        $news=$router->db->getEditorNews($_id,$search);
        $count = count($router->db->getEditorNews($_id));
        
        $router->renderView('editor/news', [
            'news' => $news,
            'search' => $search,
            'count' => $count,
        ]);
        $logger->log('Access to /editor/mynews','INFO',$_SESSION['username'],$_SESSION['role']);
    }
}