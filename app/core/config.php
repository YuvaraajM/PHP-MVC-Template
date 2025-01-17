<?php
if($_SERVER['SERVER_NAME'] == 'localhost'){
    define('ROOT', "http://localhost/php-crashCourse/MVC/public");
      # Using define to define the DB parameters
    define('DB_HOST', 'localhost');
    define('DB_PORT', 3306);
    define('DB_USER', 'user');
    define('DB_PASS', 'T5]g]mG2MC9vEXWz');
    define('DB_NAME', 'feedback_app');
} else{
    define('ROOT', "https://website.com/MVC/public");
}