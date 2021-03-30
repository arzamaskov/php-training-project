<?php

class Router
{
    /*
     * Table of routes
     */
    protected static $route_list = [];

    /*
     * Current route
     */
    protected static $route = [];

    public static function add($regexp, $route = [])
    {
        self::$route_list[$regexp] = $route;
    }

    public static function getRouteList()
    {
        return self::$route_list;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function matchRoute($url)
    {
        foreach (self::$route_list as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['mode'])) {
                    $route['mode'] = 'index';
                }
                self::$route = $route;

                return true;
            }
        }

        return false;
    }

    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $controller = self::$route['controller'];
            $mode = self::$route['mode'];

            if (class_exists($controller)) {
                echo 'OK';
            } else {
                "Контроллер $controller не найден";
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }
}
