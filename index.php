<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

 require __DIR__ . '/vendor/autoload.php';

$url=explode("/",strtok($_SERVER['REQUEST_URI'],'?'));

if(count($url)>4)
{
header("HTTP/1.1 404 Not Found");
exit;
}
if(!$url[2])
{
echo "Welcome";
exit;
}
 
$class=isset($url[2])?$url[2]:'';
$function_name=isset($url[3])?$url[3]:'';
$function=$class.ucfirst($function_name);
$c=str_replace('/','',"App\Services\/".ucfirst($class)."Service");
if(class_exists($c))
$a=new $c();
else
header("HTTP/1.1 404 Not Found");
if (method_exists($a,$function))
{
$json = file_get_contents('php://input');
$data = json_decode($json);
echo $r=$a->$function($data);
}
else
header("HTTP/1.1 404 Not Found");

 // require __DIR__ . '/vendor/autoload.php';

// $url=explode("/",strtok($_SERVER['REQUEST_URI'],'?'));
// if(count($url)>5)
// {
// header("HTTP/1.1 404 Not Found");
// exit;
// }
// if(!$url[3])
// {
// echo "Welcome";
// exit;
// }

// $class=isset($url[3])?$url[3]:'';
// $function_name=isset($url[4])?$url[4]:'';
// $function=$class.$function_name;
// $c=str_replace('/','',"App\Services\/".ucfirst($class)."Service");
// if(class_exists($c))
// $a=new $c();
// else
// header("HTTP/1.1 404 Not Found");
// if (method_exists($a,$function))
// {
// $json = file_get_contents('php://input');
// $data = json_decode($json);
// echo $r=$a->$function($data);
// }
// else
// header("HTTP/1.1 404 Not Found");



?>