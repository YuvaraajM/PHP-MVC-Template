<?php

class Home extends Controller{

    public function index($a=''){
        $model = new Model;
        echo __LINE__;
        $result = $model->first(['username'=>'Yuvaraaj M']);
        show($result);
        echo __LINE__;
        $this->view('home');
    }
}
