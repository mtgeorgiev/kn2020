<?php

spl_autoload_register(function($className){
    require_once $className . '.php';
});

$x = new User("asdasd");

var_dump($x->greet());

var_dump(User::f());

