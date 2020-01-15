<?php


namespace app\controllers;

class MainController extends AppController
{
    public function indexAction(){
        //debug($this->route);
        $this->setMeta('Main page', 'Description', 'Keywords');

        $name = 'Vahe';
        $age = 35;
        $this->set(compact('name', 'age'));
    }
}