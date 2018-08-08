<?php 
 require __DIR__ . '/vendor/autoload.php';

// $url=explode("/",$_SERVER['REQUEST_URI']);




// spl_autoload_register(function ($class_name) {
    // include $class_name . '.php';
// });


// $c=str_replace('/','',"App\Services\/".ucfirst($url[2])."Service");
// if(class_exists($c))
// $a=new $c();
// if (method_exists($a,'usersList'))
// echo $r=$a->usersList(1);

// echo phpinfo();

// use App\Services\UserService as UserService;

$a=new \App\Services\UserService;

?>