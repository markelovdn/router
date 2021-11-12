<?php
require '../app/controllers/main.php';
$query = ltrim($_SERVER['REQUEST_URI'], '/');

spl_autoload_register(function ($class_name) {
    include '../app/controllers/'.$class_name . '.php';
});

RouterAutoload::loadRoute();
Router::dispatch($query);