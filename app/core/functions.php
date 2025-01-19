<?php

# MVC - Model, View, Controller
function show($stuff){
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function esc($str){
    return htmlspecialchars($str);
}

function redirect($path){
    header("Location: ".ROOT."/".$path);
    die;
}