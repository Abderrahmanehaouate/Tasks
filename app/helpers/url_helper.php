<?php


    //simple page 

    function redirect($page){
        header('location:' .URLROOT .'/' .$page);
    }