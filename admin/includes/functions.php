<?php

function classAutoloader($class){
    $class = strtolower($class);
    $path = "includes/{$class}.php";
    if(is_file($path) && !class_exists($class)){
        include($path);
    }
}

function redirect($location = 'index.php'){
    header('Location: '.$location);
}

spl_autoload_register('classAutoloader');

?>
