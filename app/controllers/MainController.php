<?php


namespace app\controllers;

use ishop\Cache;

class MainController extends AppController
{
    public function indexAction(){
        $brands = \RedBeanPHP\R::find('brand', 'LIMIT 3');
        $this->setMeta('Main page', 'Description', 'Keywords');
        $this->set(compact('brands'));
    }
}