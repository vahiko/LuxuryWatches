<?php


namespace app\controllers;

use ishop\Cache;

class MainController extends AppController
{
    public function indexAction(){
        //debug($this->route);
        $this->setMeta('Main page', 'Description', 'Keywords');
    }
}