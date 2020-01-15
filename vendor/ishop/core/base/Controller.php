<?php


namespace ishop\base;

// this is the base controller of our framework for further applications as well
abstract class Controller
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $layout;
    public $data = []; // data to pass to view to render, generally these are data from database
    public $meta = ['title'=>'', 'desc'=>'', 'keywords'=>'']; // these are metadata about page to pass to layout, we can create
    // them in the appropriate action for the coresponding view

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];

    }

    // this method creates a View object and call its method render() to render the view
    public function getView(){
        $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObject->render($this->data);
    }

    // to set data to property data[]
    public function set($data){
        $this->data = $data;
    }

    // to put certain information into the controller, in order to pass that information to other parts of application
    public function setMeta($title = '', $desc = '', $keywords = ''){
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }
}