<?php 

if (! function_exists('autoloadClassMultipleDirectory')) {
    function autoloadClassMultipleDirectory($class_name)
    {
        $array_paths = array(
            '/../config/',
            '/../controller/', 
            '/../dao/', 
            '/../model/',
            '/../view/',
            '/../lib/modules/',
            '/../lib/processes/'
        );
        foreach ($array_paths as $path) {
            $file = dirname(__FILE__) . $path . $class_name . '.php';
            if (is_file($file)) {
                require_once $file;
            }
        }
    }
}
