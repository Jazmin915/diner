<?php

/**
 * Order class represents an order from my diner
 * @Jazmin Gonzalez
 */

class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    //define a constructor
    function __construct()
    {
        //initialize our field values
        $this->_food = "";
        $this->_meal = "";
        $this->_condiments = "";
    }

    //we need to put in a return statements and param statements
    //for our methods in php
    //the only way someone using this class would know what
    //data to pass in to the method or what data is returned
    //is if we specify it in the comments
    //create some getters and setters
    /**
     * getFood returns the food item ordered
     * @return string
     */
    public function getFood()
    {
        return $this->_food;
    }

    //takes in a param string
    //set method takes in a parameter and assigns it to the field

    /**
     * setFood sets the food item order
     * @param string
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**
     * getMeal returns the meal item ordered
     * @return string
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * setMeal sets the food item order
     * @return string
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**
     * getCondiments returns the meal item ordered
     * @return string
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    /**
     * setCondiments sets the food item order
     * @return string
     */
    public function setCondiments($condiments)
    {
        $this->_condiments = $condiments;
    }
}
