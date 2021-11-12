<?php

class test
{
    public function __construct()
    {
        return true;
    }

    public static function index(){
        include '../public/views/test/index.php';
    }
    public function newtest(){
              include '../public/views/test/create.php';
    }
    public function edittest(){
        include '../public/views/test/edit.php';
    }

    public function deletetest(){
        return true;
    }
}