<?php
require '../vendor/core/Router.php';
require '../app/routes/routes.php';
require '../vendor/libs/functions.php';
$query = ltrim($_SERVER['REQUEST_URI'], '/');

spl_autoload_register(function ($class_name) {
    include '../app/controllers/'.$class_name . '.php';
});


//autoloadRoutes();
//dd(autoloadRoutes());
//dd(Router::getRoutes());



Router::dispatch($query);


autoloadRoutes();




