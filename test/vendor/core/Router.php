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
        foreach(self::$routes as $useruri => $route){
            if($url == $useruri){
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
               }
           }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }
}






























//
//
//class Router {
//
//    private $uri = [];
//    private $controller = [];
//
//    //Собирает массив адресов из адресной строки
//    public function add($uri, $controller = null) {
//        $this->uri[] = $uri;
//
//        if ($controller != null) {
//            $this->controller[] = $controller;
//        }
//    }
//
//    public function go() {
//        $uriGetParam = isset($_GET['uri']) ? $_GET['uri'] : '/';
//        foreach ($this->uri as $k=>$v) {
//            if (preg_match("#^$v$#", $uriGetParam)) {
//                if (is_string($this->controller[$k])){
//                    $useMethod = $this->controller[$k];
//                    new $useMethod();
//                } else {
//                    call_user_func($this->controller[$k]);
//                }
//            }
//        }
//    }
//}