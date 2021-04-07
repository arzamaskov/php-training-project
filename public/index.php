<?php

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');

require_once '../vendor/core/Router.php';
require_once '../vendor/libs/functions.php';

spl_autoload_register(function($class) {
    $file = APP . "/controllers/$class.php";
    if(is_file($file)) {
        require_once $file;
    }
});

Router::add('^pages/?(?P<mode>[a-z-]+)?$', ['controller' => 'Posts']);

// Default routes
Router::add('^$', ['controller' => 'Main', 'mode' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<mode>[a-z-]+)?$', []);

/* debug(Router::getRouteList()); */

Router::dispatch($query);
