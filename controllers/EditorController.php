<?php

namespace app\controllers;

use app\Router;
use app\controllers\NewsController;
use app\Authentication;

class EditorController
{
    public static function index(Router $router){
        $router->renderView('editor/index', [
        ]);
        
    }

    public static function editorNews(Router $router)
    {
        $_id = Authentication::getUserSessionInfo('_id');
        $search = $_GET['search'] ?? '';
        $news=$router->db->getEditorNews($_id,$search);
        $count = count($router->db->getEditorNews($_id));
        
        $router->renderView('editor/news', [
            'news' => $news,
            'search' => $search,
            'count' => $count,
        ]);
    }

    public static function update(Router $router){
        $router->renderView('editor/index', [
        ]);
        
    }
    

}