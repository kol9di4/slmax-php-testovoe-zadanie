<?php

spl_autoload_register(function($name){
    $path = str_replace('\\', '/', $name) . '.php';

    if(file_exists($path)){
        include_once($path);
    }
    if(!class_exists($name,true) and !interface_exists($name)){
        throw new Exception('Unable to load class or interface: ' . $name);
    }

});