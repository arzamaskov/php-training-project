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

    /**
     * Return current route.
     *
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * Finds a route in the routes list.
     *
     * @param string $url incoming URL
     *
     * @return bool
     */
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

    /**
     * Redirect URL to the valid route.
     *
     * @param string $url incoming URL
     *
     * @return void
     */
    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $controller = self::upperCamelCase(self::$route['controller']);
            if (class_exists($controller)) {
                $cObj = new $controller;
                $mode = self::lowerCamelCase(self::$route['mode']) . 'Mode';
                if(method_exists($cObj, $mode)) {
                    $cObj->$mode();
                } else {
                    echo "Мод <b>$controller::$mode</b> не найден";
                }
            } else {
                echo "Контроллер <b>$controller</b> не найден";
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }

    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
}
