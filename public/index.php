<?php
ob_start();
session_start();
date_default_timezone_set('Turkey');

require_once __DIR__.'/../vendor/autoload.php';

use app\Router;
use app\controllers\NewsController;
use app\controllers\ApiController;
use app\controllers\UserController;
use app\controllers\EditorController;
use app\controllers\ModController;
use app\controllers\AdminController;
use app\Authorization;

$auth = new Authorization;
$router = new Router();

/**
 * Route lar alanındaki izlediğim mantık şu: Herkesin her zaman erişebileceği route'lar var. Bu da haberler ve haberin detayları.
 * Geri kalan route lar da, kullanıcının login işlemi gerçekleştirip gerçekleştirmediğine ya da auth level'ının yeterli olup olmadığına göre değişiyor.
 * Eğer bir route kullanıcı için tanımlanmıyorsa ya da geçersiz bir route girmişse, / yani /news (haberlerin gösterildiği anasayfa) sayfasına yönlendirilir.
 **/

//Herkesin erişebileceği route lar
$router ->get('/',[NewsController::class, 'index']); //News list
$router ->get('/news',[NewsController::class, 'index']); //News list
$router ->get('/news/spesific',[NewsController::class,'viewSpesificNews']); //Haber detayını herkes görebilir
$router->get('/api/news',[ApiController::class, 'api']);

//News type routes start
$router ->get('/news/science',[NewsController::class,'viewNewsWithCategory']);
$router ->get('/news/health',[NewsController::class,'viewNewsWithCategory']);
$router ->get('/news/technology',[NewsController::class,'viewNewsWithCategory']);
$router ->get('/news/world',[NewsController::class,'viewNewsWithCategory']);
$router ->get('/news/economy',[NewsController::class,'viewNewsWithCategory']);
$router ->get('/news/sports',[NewsController::class,'viewNewsWithCategory']);       // => type a göre news herkes erişebilir
$router ->get('/news/art',[NewsController::class,'viewNewsWithCategory']);
$router ->get('/news/education',[NewsController::class,'viewNewsWithCategory']);
$router ->get('/news/social',[NewsController::class,'viewNewsWithCategory']);
$router ->get('/news/political',[NewsController::class,'viewNewsWithCategory']);
//News type routes end

$router ->get('/about',[NewsController::class,'about']); //About sayfasına herkes erişebilir

if ($auth->isLoggedIn()){//Giriş yapan kullanıcılar için route lar
    $router ->get('/users',[UserController::class, 'index']); //Giriş varsa user bilgileri(index)
    $router ->post('/users',[UserController::class, 'deleteUser']);// Kullanıcı hesap silme
    $router ->get('/users/logout',[UserController::class, 'logout']); //Giriş varsa logout hakkı olur
    $router ->post('/news/spesific',[NewsController::class,'viewSpesificNews']); //Habere yorum atmak (post) için giriş gerekir.
    $router ->get('/news/forme',[NewsController::class,'viewNewsForUser']); //Kullanıcının seçtiği haber kategorilerine göre haberler
    $router ->get('/users/category',[UserController::class, 'updateUserCategories']); //Kullanıcı haber tercihleri düzenleme
    $router ->post('/users/category',[UserController::class, 'updateUserCategories']); //Kullanıcı haber tercihleri düzenleme
    $router ->get('/users/newsread',[UserController::class, 'getUserNewsRead']); //Kullanıcı okunan haberleri görme
    $router ->get('/users/comments',[UserController::class, 'getUserComments']); //Kullanıcı yorumları görme
    

    
    if ($auth->getAuthLevel() > 1){ //1(Kullanıcı)'den büyük auth level, editör ve sonrası demek.
        $router ->get('/editor',[EditorController::class, 'index']);
        $router ->get('/editor/createnews',[NewsController::class, 'editorCreate']);
        $router ->post('/editor/createnews',[NewsController::class, 'editorCreate']); 
        $router ->get('/editor/updatenews',[NewsController::class, 'editorUpdate']);
        $router ->post('/editor/updatenews',[NewsController::class, 'editorUpdate']);
        $router ->get('/editor/mynews',[EditorController::class, 'editorNews']);
    }
    if ($auth->getAuthLevel() > 2){ //2(Editör)'den büyük auth level, mod ve sonrası demek.
        $router ->get('/mod',[ModController::class, 'index']); //Mod paneli
        $router ->get('/mod/editorcategory',[ModController::class, 'updateEditorCategories']);
        $router ->post('/mod/editorcategory',[ModController::class, 'updateEditorCategories']);
        $router ->get('/mod/promote',[ModController::class, 'promote']);
        $router ->post('/mod/promote',[ModController::class, 'promote']);
        $router ->get('/mod/showusers',[ModController::class, 'usersAndEditors']);
        $router ->get('/mod/deletedusers',[ModController::class, 'deletedUsers']);
        $router ->get('/mod/comments',[ModController::class, 'manageComments']);
        $router ->get('/mod/editcomment',[ModController::class, 'updateComments']);
        $router ->post('/mod/editcomment',[ModController::class, 'updateComments']);
        $router ->get('/mod/news',[ModController::class, 'manageNews']);
        $router ->get('/mod/editnews',[NewsController::class, 'update']);
        $router ->post('/mod/editnews',[NewsController::class, 'update']);
        $router ->get('/mod/createnews',[NewsController::class, 'create']);
        $router ->post('/mod/createnews',[NewsController::class, 'create']);
        $router ->get('/mod/activities',[ModController::class, 'activities']);


    }
    if ($auth->getAuthLevel() > 3){ //3(Mod)'den büyük auth level, admin demek.
        $router ->get('/admin',[AdminController::class, 'index']); //Admin paneli
        $router ->get('/admin/promote',[AdminController::class, 'promote']);
        $router ->post('/admin/promote',[AdminController::class, 'promote']);
        $router ->get('/admin/activities',[AdminController::class, 'activities']);
        $router ->get('/admin/users',[AdminController::class, 'users']);
    }

}else{//Giriş yapmayan kullanıcılar için route lar
    $router ->get('/users/register',[UserController::class, 'create']); //Giriş yoksa register get
    $router ->post('/users/register',[UserController::class, 'create']); //Giriş yoksa register post
    $router ->get('/users/login',[UserController::class, 'login']); //Giriş yoksa login get 
    $router ->post('/users/login',[UserController::class, 'login']); //Giriş yoksa login post
}

$router->resolve();