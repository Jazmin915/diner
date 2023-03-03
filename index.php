<?php
// order1 route -> views/order-form1.html
// summary route -> views/order-summary.html

//This is my controller

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validate.php');
require_once ('classes/order.php');

//Start a session AFTER requiring autoload.php
session_start();
//var_dump($_SESSION);


//test code for classes
/*$myOrder = new Order();
$myOrder->setFood("tacos");
echo $myOrder->getFood();
var_dump($myOrder);*/

/*$myOrder->setMeal("breaky");
echo $myOrder->getMeal();

$myOrder->setCondiments("Mayo");
echo $myOrder->getCondiments();

var_dump($myOrder);*/


/*$food1 = "tacos";
$food2 = "";
$food3 = "x";
echo validFood($food1) ? "valid" : "not valid";
echo validFood($food2) ? "valid" : "not valid";
echo validFood($food3) ? "valid" : "not valid";*/


//var_dump(getMeals());

//Instantiate F3 Base class
$f3 = Base::instance();

//Define a default route (328/diner)
$f3->route('GET /', function() {

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/diner-home.html");

});

//Define a breakfast route (328/diner/breakfast)
$f3->route('GET /breakfast', function() {

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/breakfast.html");

});

//Define an order1 route (328/diner/order1)
$f3->route('GET|POST /order1', function($f3) {

    //var_dump($_POST);
    //["food"]=> string(5) "pizza" ["meal"]=> string(9) "breakfast" }

    //If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $newOrder = new Order();

        $food = trim($_POST['food']);
        if (validFood($food)) { //if the food is valid we put it in a session array otherwise we set a string as an error message and put it into an array called errors inside the fatfree hive
            $newOrder->setFood($food);
            //$_SESSION['food'] = $food; //Before we would Move data from POST array to SESSION array
        } //if its not valid create a variable to store the error message
        else {
            $f3->set('errors["food"]',
                'Food must have at least 2 chars');
        }

        //Validate the meal
        $meal= $_POST['meal'];
        if(validMeal($meal)){
            $newOrder->setMeal($meal);
            //$_SESSION['meal'] = $meal;
        } else {
            $f3->set('errors["meal"]',
                    'Meal is invalid');
        }

        //if there are no errors, put the newOrder object
        //into the session array,
        //then go to next page
        if (empty($f3->get('errors'))){
            $_SESSION['newOrder'] = $newOrder;
            $f3->reroute('order2');
        }

    }

    //Add meals to F3 hive
    $f3->set('meals', getMeals());

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/order-form1.html");

});

//Define an order2 route (328/diner/order2)
$f3->route('GET|POST /order2', function($f3) {

    //If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //one way of adding conds to newOrder object
        /*$newOrder = $_SESSION['newOrder'];
        $condString = implode(", ",$_POST['conds']);
        $newOrder->setCondiments($condString);
        //put the object back in the session array
        $_SESSION['newOrder'] = $newOrder;*/

        //second way of adding
        $condString = implode(", ",$_POST['conds']);
        $_SESSION['newOrder']->setCondiments($condString);

        //$_SESSION['conds'] = implode(", ",$_POST['conds']);

        //Redirect to summary page
        $f3->reroute('summary');
    }

    //Add condiments to F3 hive
    $f3->set('condiments', getCondiments());

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/order-form2.html");

});

//Define a summary route (328/diner/summary)
$f3->route('GET /summary', function() {

    //write to Database

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/order-summary.html");

    //Destroy the session array
    session_destroy();

});


//Run Fat Free
$f3->run();


/*// This is my CONTROLLER for the hello project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start Session

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


//define an order route
$f3->route('GET|POST /order1', function ($f3) {

    //If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Move the data from POST array to SESSION array
        $_SESSION['food'] = $_POST['food'];
        $_SESSION['meal'] = $_POST['meal'];

        //Redirect to the summary page
        $f3->reroute('summary');
    }

    //Instantiate a view
    //Template is a class in the fat free framework
    $view = new Template();
    echo $view->render("views/order-form1.html");
});

$f3->route('GET|POST /order2', function () {

    //Instantiate a view
    //Template is a class in the fat free framework
    $view = new Template();
    echo $view->render("views/order-form2.html");
});

//a summary route ---> views/order-summary.html
$f3->route('GET /summary', function () {

    //Instantiate a view
    //Template is a class in the fat free framework
    $view = new Template();
    echo $view->render("views/order-summary.html");
});

//Run Fat-free
$f3->run();
// Java -> f3.run();*/