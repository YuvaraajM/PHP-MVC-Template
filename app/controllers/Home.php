<?php

class Home{
    
    use Model;
    use Controller;
    
    public function index($a='', $b='', $c=''){
        // $user = new User;
        // $data['username']='Yuvaraaj';
        // $data['body'] = 'test template 102';
        // $result = $user->findAll();
        // show($result);
        show("from the index fn");
        $this->view('home');
    }

    public function edit($a='', $b='', $c=''){
        show("from the edit fn");
        $this->view('home');
    }
}
