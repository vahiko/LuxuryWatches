<?php


namespace app\controllers;


use app\models\AppModel;
use ishop\base\Controller;

// this is the application controller that inherit from the base controller of the framework,
// and all other controllers will inherit from this class
class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();  // On create AppModel object to initialize a connection to the db
    }
}