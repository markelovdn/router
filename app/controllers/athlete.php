<?php

class athlete
{

    public function all(){
        include '../public/views/athlete/index.php';
    }
    public function newathlete(){
        include '../public/views/athlete/create.php';
    }
    public function editathlete(){
        include '../public/views/athlete/edit.php';
    }
}