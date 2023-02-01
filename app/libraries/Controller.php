<?php
/**
 * Base controller
 * loads the models and views
 */

class Controller {
    //load model 
    public function model($model){
        //require model file 
        require_once '../app/models/' . $model . '.php';

        //instatiate model
        return new $model();
    }


    //load views
    public function view($views, $data= []){ 
        //check for view file 
        if(file_exists('../app/views/' . $views . '.php')){
            require_once '../app/views/' . $views . '.php';
        }else {
            // View does not exist
            die('Views does not exist');
        }
    }
}