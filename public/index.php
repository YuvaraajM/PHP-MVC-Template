<?php
session_start();
require "../app/core/init.php";
// echo phpinfo();
$app = new App;
$app->loadController();