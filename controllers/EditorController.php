<?php

namespace app\controllers;

use app\Router;
use app\Database;
use app\models\Editor;

class EditorContoller
{
    public static function index(Router $router){
        $router->renderView('panels/editor/index', [
        ]);
        
    }
}