<?php


namespace app\controllers;

use ishop\Cache;

class MainController extends AppController
{
    public function indexAction(){
        $brands = \RedBeanPHP\R::find('brand', 'LIMIT 3');
        $hits = \RedBeanPHP\R::find('product', "hit = '1' AND status = '1' LIMIT 8");
        $this->setMeta('Main page', 'Description', 'Keywords');
        $this->set(compact('brands', 'hits'));
    }
}