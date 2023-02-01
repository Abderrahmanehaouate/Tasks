<?php
/*
 * App core class 
 * creates URL & loads core controller 
 * URL FORMAT - /controller/method/params 
 */

class Core {
    
    protected $currentController = 'Reservations';
    protected $currentMethod = 'getReservation';
    protected $params = [];


    public function __construct(){

        $url = $this->getUrl();
      // Look in controllers for first value
    if(isset($url[0])){
        if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
            // If exists, set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        }
    }
        // Require the  controller 
        require_once '../app/controllers/'. $this->currentController . '.php';
        
        // Instantiate controller class 
        $this->currentController = new $this->currentController;
        //check for second part of url 
        if(isset($url[1])){
            
            if(method_exists($this->currentController,$url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        //Get params
        $this->params = $url ? array_values($url) : [];

        //call a claback with array o params
        call_user_func_array([$this->currentController ,$this->currentMethod], $this->params);
    }

    public function getUrl(){

        if(isset($_GET['url'])){

            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }
    }


}