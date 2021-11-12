<?php
require '../vendor/core/Router.php';
require '../vendor/core/RouterAutoload.php';
require '../app/routes/routes.php';
class main
{
    public function index() {

        include '../public/views/main.php';
    }

}