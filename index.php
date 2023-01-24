<?php
// This is my CONTROLLER for the hello project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

// Create an instance of the Base class (instantiate F3 base class)
$f3 = Base::instance();
// Java equivalent -> Base f3 = new Base();

// Define a default route ("home page" for 328/diner)
$f3->route('GET /', function () {

    //Instantiate a view
    //Template is a class in the fat free framework
    $view = new Template();
    echo $view->render("views/diner-home.html");
});


// a breakfast route (328/diner/breakfast)
$f3->route('GET /breakfast', function () {

    //Instantiate a view
    //Template is a class in the fat free framework
    $view = new Template();
    echo $view->render("views/breakfast.html");
});


// a lunch route (328/diner/lunch)
$f3->route('GET /lunch', function () {

    //Instantiate a view
    //Template is a class in the fat free framework
    $view = new Template();
    echo $view->render("views/lunch.html");
});

//Run Fat-free
$f3->run();
// Java -> f3.run();