<?php
ob_start();
session_start();
require_once __DIR__.'/../vendor/autoload.php';

use app\Router;
use app\controllers\NewsController;
use app\controllers\ApiController;
use app\controllers\UserController;
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
$router->get('/news/api',[ApiController::class, 'apiAll']);
$router->get('/news/api/one',[ApiController::class, 'apiOne']);

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
    $router ->get('/users/logout',[UserController::class, 'logout']); //Giriş varsa logout hakkı olur
    $router ->post('/news/spesific',[NewsController::class,'viewSpesificNews']); //Habere yorum atmak (post) için giriş gerekir.
    $router ->get('/news/forme',[NewsController::class,'viewNewsForUser']); //Kullanıcının seçtiği haber kategorilerine göre haberler
    
    if ($auth->getAuthLevel() > 1){ //1(Kullanıcı)'den büyük auth level, editör ve sonrası demek.
        $router ->get('/news/create',[NewsController::class, 'create']); //Create news get 
        $router ->post('/news/create',[NewsController::class, 'create']); //Create news post 
        $router ->get('/news/update',[NewsController::class, 'update']); //Update news get
        $router ->post('/news/update',[NewsController::class, 'update']); //Update news post
        $router ->post('/news/delete',[NewsController::class, 'delete']); //Delete news 
        //$router ->get('/panels/editor',); //Editör paneli
        //$router ->post('/panels/editor',); //Editör paneli
    }
    elseif ($auth->getAuthLevel() > 2){ //2(Editör)'den büyük auth level, mod ve sonrası demek.
        //$router ->get('/panels/mod',); //Mod paneli
        //$router ->post('/panels/mod',); //Mod paneli
    }
    elseif ($auth->getAuthLevel() > 3){ //3(Mod)'den büyük auth level, admin demek.
        //$router ->get('/panels/admin',); //Admin paneli
        //$router ->post('panels/admin',); //Admin paneli
    }

}else{//Giriş yapmayan kullanıcılar için route lar
    $router ->get('/users/register',[UserController::class, 'create']); //Giriş yoksa register get
    $router ->post('/users/register',[UserController::class, 'create']); //Giriş yoksa register post
    $router ->get('/users/login',[UserController::class, 'login']); //Giriş yoksa login get 
    $router ->post('/users/login',[UserController::class, 'login']); //Giriş yoksa login post
}

$router->resolve();