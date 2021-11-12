<?php


class Router {

    /*
     * array - All possible routes of your site are in the folder app/routes/routes.php
     */
    protected static $routes = [];
    /*
     * array - Current route from browser address bar
     */
    protected static $route = [];

    /*
     * return array
     * This method returns an array of your site's routes
     */
    public static function add($uri, $route) {
        self::$routes[$uri] = $route;
    }

     /*
     * Helper method for displaying all available site routes
     */
    public static function getRoutes() {
        return self::$routes;
    }

    /*
     * Helper method for displaying the current site route
     */
    public static function getRoute() {
        return self::$route;
    }

    /*
     * return true
     * This method compares all the routes of the site with the route entered in the address bar of the browser
     */
    public static function matchRoute($url) {
        foreach(self::$routes as $useruri => $route) {
            if($url == $useruri) {
                self::$route = $route;
                return true;
            } return false;
        }
    }

    /*
     * The main method of the class, if the route from the address bar matches those on the site,
     * creates an object of the controller class with the available methods. Otherwise, it outputs a 404 error template
     */
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