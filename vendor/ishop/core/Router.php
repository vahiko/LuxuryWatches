<?php


namespace ishop;

// Class who is responsable for routing messages to appropriate controllers and actions
class Router
{
    // un array to keep routes
    protected static $routes = [];
    // un array for current route
    protected static $route = [];

    // this function add routes to self::routes (our routes )
    public static function add($regex, $route = []){
        self::$routes[$regex] = $route;
    }

    public static function getRoutes(){
        return self::$routes;
    }

    public static function getRoute(){
        return self::$route;
    }

    // this function receives urls from address bar
    public static function dispatch($url){
        if(self::matchRoute($url))
        {
            echo "OK";
        }else
            echo "NO";

    }

    // this function search if the page asked exists
    public static function matchRoute($url){
        return false;
    }
}