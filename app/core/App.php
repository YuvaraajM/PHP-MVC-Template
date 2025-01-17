<?php
class App{
    private $controller = 'Home';
    private $method = 'index';
    
    private function splitURL(){
        show($_GET);
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL);
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
        } else{
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }
        
        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], ['a'=>'a something']);
    }
}


