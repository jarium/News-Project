<?php
ob_start();
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use app\Router;
use app\controllers\NewsController;
use app\controllers\UserController;
use app\Authorization;

$auth = new Authorization;
$router = new Router();

/**
 * Route lar alanındaki izlediğim mantık şu: Herkesin her zaman erişebileceği bir route var. Bu da haberler ve haberin detayları.
 * Geri kalan route lar da, kullanıcının login işlemi gerçekleştirip gerçekleştirmediğine ya da auth level'ının yeterli olup olmadığına göre değişiyor.
 * Eğer bir route kullanıcı için tanımlanmıyorsa ya da geçersiz bir route girmişse, / yani /news (haberlerin gösterildiği anasayfa) sayfasına yönlendirilir.
 **/

//Herkesin erişebileceği route lar
$router ->get('/',[NewsController::class, 'index']); //News list
$router ->get('/news',[NewsController::class, 'index']); //News list
//$router ->get("/news?_id=$id",[NewsController::class,'viewSpesificNews']);



if ($auth->isLoggedIn()){//Giriş yapan kullanıcılar için route lar
    $router ->get('/users',[UserController::class, 'index']); //Giriş varsa user bilgileri(index)
    $router ->get('/users/logout',[UserController::class, 'logout']); //Giriş varsa logout hakkı olur
    
    if ($auth->getAuthLevel() > 1){ //1(Kullanıcı)'den büyük auth level, editör ve sonrası demek.
        $router ->get('/news/create',[NewsController::class, 'create']); //Create news get (editor + only)
        $router ->post('/news/create',[NewsController::class, 'create']); //Create news post (editor + only)
        $router ->get('/news/update',[NewsController::class, 'update']); //Update news get(editor + only, max 2 gün geçmiş olmalı)
        $router ->post('/news/update',[NewsController::class, 'update']); //Update news post(editor + only, max 2 gün geçmiş olmalı)
        $router ->post('/news/delete',[NewsController::class, 'delete']); //Delete news 
    }
    elseif ($auth->getAuthLevel() > 2){ //2(Editör)'den büyük auth level, mod ve sonrası demek.
        //$router ->get('/panel',); //Mod paneli
        //$router ->post('/panel',); //Mod paneli
    }
    elseif ($auth->getAuthLevel() > 3){ //3(Mod)'den büyük auth level, admin demek.
        //$router ->get('/admin',); //Admin paneli
        //$router ->post('/admin',); //Admin paneli
    }

}else{//Giriş yapmayan kullanıcılar için route lar
    $router ->get('/users/register',[UserController::class, 'create']); //Giriş yoksa register get
    $router ->post('/users/register',[UserController::class, 'create']); //Giriş yoksa register post
    $router ->get('/users/login',[UserController::class, 'login']); //Giriş yoksa login get 
    $router ->post('/users/login',[UserController::class, 'login']); //Giriş yoksa login post
}

$router->resolve();