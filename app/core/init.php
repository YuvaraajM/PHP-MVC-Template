<?php 

# check if a class is called which doesn't exist, this is called
spl_autoload_register(function($classname){
    $filename= "../app/models/".ucfirst($classname).".php";
    echo $filename;
    require $filename;
});

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';