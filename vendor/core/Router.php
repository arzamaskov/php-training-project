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
            if ($pattern == $url) {
                self::$route = $route;

                return true;
            }
        }

        return false;
    }
}
