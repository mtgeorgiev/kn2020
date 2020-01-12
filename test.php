<?php

var_dump(date("Y-m-d H:i:s"));

spl_autoload_register(function($className){
    require_once $className . '.php';
});

$x = new User("asdasd");

var_dump($x->greet());

var_dump(User::f());

