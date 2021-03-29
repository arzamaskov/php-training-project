<?php

$query = rtrim($_SERVER['QUERY_STRING'], '/');

require_once '../vendor/core/Router.php';
require_once '../vendor/libs/functions.php';

Router::add('^$', ['controller' => 'Main', 'mode' => 'index']);
Router::add('^(?P<controller>[a-z-]+).?(?P<mode>[a-z-]+)?$', []);

debug(Router::getRouteList());

Router::dispatch($query);

