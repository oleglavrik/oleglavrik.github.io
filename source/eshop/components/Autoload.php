<?php

    function __autoload($classname){
        # List all the class directories in array
        $array_path = array(
            '/models/',
            '/components/'
        );

        foreach($array_path as $path){
            $path = ROOT . $path . $classname . '.php';
            if(is_file($path)){
                include_once($path);
            }
        }
    }