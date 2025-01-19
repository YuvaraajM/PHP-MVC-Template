<?php
class App{
    private $controller = 'Home';
    private $method = 'index';
    
    private function splitURL(){
        show($_GET);
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL, "/"));
        return $URL;
    }

    public function loadController(){
        $URL = $this->splitURL();
        show($URL);
        $filename = "../app/controllers/".ucfirst($URL[0]).".php";
        show($filename);
        if(file_exists($filename)){
            require $filename;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]); # to pass the rest of the data to other functions.
        } else{
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }
        
        $controller = new $this->controller;
        # Select specific method from the object
        if(!empty($URL[1])){
            if(method_exists($controller, $URL[1])){
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        show($URL);
        call_user_func_array([$controller, $this->method], $URL);
    }
}


