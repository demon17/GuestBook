<?php
//requiring the twig utilities
require_once dirname(__DIR__) . '/vendor/Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

//automatically load the class file when instantiating a class
spl_autoload_register(function($class) {
    $root = dirname(__DIR__); //get the parent directory(root)
    $file = $root . '/' . str_replace('\\','/',$class) . '.php';
    if(is_readable($file)) {
        require $file;
    }
});


//display all php errors
error_reporting(E_ALL);
//set a predefined error handler function
set_error_handler('Core\Error::errorHandler');
//set a predefined exception handler function
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();

//Add the routes
$router->add('',['controller' => 'Home', 'action' => 'index']);
$router->add('about',['controller' => 'Home', 'action' => 'about']);
$router->add('contact',['controller' => 'Home', 'action' => 'contact']);
$router->add('create',['controller' => 'Home', 'action' => 'create']);
$router->add('login',['controller' => 'Login', 'action' => 'index']);
$router->add('news',['controller' => 'News', 'action' => 'index']);
$router->add('shownews/meteo',['controller' => 'Home', 'action' => 'meteo']);
$router->add('shownews/curs',['controller' => 'Home', 'action' => 'curs']);
$router->add('shownews/{id:[a-zA-Z0-9_-]+}',['controller' => 'News', 'action' => 'display']);
$router->add('{controller}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);
?>