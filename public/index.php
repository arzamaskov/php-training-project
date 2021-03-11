<?php

$query = rtrim($_SERVER['QUERY_STRING'], '/');

require_once '../vendor/core/Router.php';
require_once '../vendor/libs/functions.php';

Router::add('posts.add', ['controller' => 'Posts', 'mode' => 'add']);
Router::add('posts', ['controller' => 'Posts', 'mode' => 'index']);
Router::add('', ['controller' => 'Main', 'mode' => 'index']);

debug(Router::getRouteList());

if (Router::matchRoute($query)) {
    debug(Router::getRoute());
} else {
    echo '404';
}
