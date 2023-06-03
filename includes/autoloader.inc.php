<?php 
spl_autoload_register('autoLoader');

function autoLoader($classname) {
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    if (strpos($url, 'includes') !== false) {
        $path = '../classes/';
    } else {
        $path = 'classes/';
    }

    $extension = '.class.php';
    $fullpath = $path . $classname . $extension;

    include_once $fullpath;
}


// spl_autoload_register('autoLoader');

// function autoLoader($classname){

//     $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//     if (strpos($url, 'inclusdes')!==false)
//     {
//         $path = '../classes';
//     }
//     else
//     {
//         $path = 'classes/';
//     }
//     $extension = '.class.php' ;
//     $fullpath = $path . $classname . $extension  ;

//     include_once $fullpath;
// }

// spl_autoload_register('autoLoader');

// function autoLoader($classname) {
//     $path = $_SERVER['DOCUMENT_ROOT'] . '/classes/'; // Set the correct path to the classes folder

//     $extension = '.class.php';
//     $fullpath = $path . strtolower($classname) . $extension;

//     include_once $fullpath;
// }
