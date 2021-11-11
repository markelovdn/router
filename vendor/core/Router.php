<?php


class Router {


    protected static $routes = []; //список всех возможных маршрутов на сайте
    protected static $route = []; //текущий маршрут из адресной строки

    //метод для наполнения массива $routes
    public static function add($uri, $route) {
        self::$routes[$uri] = $route;
    }

    //вспомогательный метод для вывода на экран всех маршрутов
    public static function getRoutes() {
        return self::$routes;
    }
    //вспомогательный метод для вывода на экран текущего маршрута
    public static function getRoute() {
        return self::$route;
    }

    public static function matchRoute($url) {
        foreach(self::$routes as $pattern => $route){
            if($url == $pattern){
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url){
        if(self::matchRoute($url)){
           $controller = self::$route['controller'];
           if (class_exists($controller)) {
               $class = new $controller;
               $method = self::$route['action'];
               if (method_exists($class, $method)) {
                   $class->$method();
               }else {
                   echo "Данный метод отсутвует в классе $class";
               }
           } else {
               echo "Контроллер $controller не найден";
           }
        }else{
            http_response_code(404);
            include '404.html';
        }
    }

}