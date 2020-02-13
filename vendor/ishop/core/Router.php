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
        $url=self::removeQueryString($url); //we parse the url and leave only the part before symbole ?
        if(self::matchRoute($url))
        {
            $controller = 'app\controllers\\'.self::$route['prefix'].self::$route['controller'].'Controller';
            if(class_exists($controller)){
                $controllerObject = new $controller(self::$route);
                $action = self::$route['action'].'Action';
                if(method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                    $controllerObject->getView();
                }else{
                    throw new \Exception("The action $controller::$action does not exist", 404);
                }
            }else{
                throw new \Exception("The controller $controller does not exist", 404);
            }
        }else
            throw new \Exception("Page not found", 404);

    }

    // this function search if the page asked exists
    public static function matchRoute($url){
        foreach(self::$routes as $pattern=>$route){
            if(preg_match("#{$pattern}#", $url, $matches)){
                foreach($matches as $k=>$v){
                    if(is_string($k)){
                        $route[$k]=$v;
                    }
                }
                if(empty($route['action']))
                {
                    $route['action'] = 'index';
                }
                if(!isset($route['prefix'])){
                    $route['prefix'] = '';
                }
                else{
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::lowerCamelCase($route['action']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    // to convert controller part of the address to UpperCamelCase
    protected static function upperCamelCase($name){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
        //debug($name);
    }

    // to convert action names to lowerCamelCase
    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));
    }

    // we use this function to get url part without explicit get parameters, otherwise explicit get parameters afteer '?'
    // would be interpreted as the part of controller or action name and give routing error
    public static function removeQueryString($url){
       if($url){
           $params = explode('&', $url, 2); // we divide in two parties the url by '&' symbol
            if(false===strpos($params[0], '=')){ //if in the first part there is no '=' symbol it means that it is nonexplicit gte parameter of url
                return rtrim($params[0], '/');   // we return taht part as url to routing
            }else{
                return ''; // otherwise we return empty space to mention that default controller and action should be called
            }
       }
    }

}