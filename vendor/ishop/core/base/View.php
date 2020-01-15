<?php


namespace ishop\base;

// this is the base view class
class View
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $data = [];
    public $meta = [];
    public $layout;

    public function __construct($route, $layout = '', $view = '', $meta){
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ? :LAYOUT;
        }
    }

    // this function will creat the view with layout
    public function render($data){
        //we create the file of the view
        $viewFile = APP."/views/{$this->prefix}{$this->controller}/{$this->view}.php";
        // if the file exists with include that file
        if(is_file($viewFile)){
            //we open the buffer and put the output into buffer and write it back into a variable $content, in order to not show the view without layout
            ob_start();
            require_once $viewFile;
            // the output of the file is in variable $content
            $content = ob_get_clean();
        }else{
            throw new \Exception("View not found {$viewFile}", 500);
        }

        //here we load the layout if it is not false, it means that if it is false we do not need to load a layout, we show view without layout
        if(false !== $this->layout)
        {
            $layoutFile = APP."/views/layouts/{$this->layout}.php";
            if(is_file($layoutFile)){
                require_once $layoutFile;
            }else{
                throw new \Exception("The layout {$layoutFile} not found", 500);
            }
        }

    }

    // we use this function to pass to layout the meta data, we call this function in the layout
    public function getMeta(){
        $output = '<title>'.$this->meta['title'].'</title>';
        $output .='<meta name="description" content="'.$this->meta['desc'].'">';
        $output .='<meta name="keywords" content="'.$this->meta['keywords'].'">';
        return $output;
    }


}