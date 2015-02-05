<?php

class Address  // defining a new class with five properties
{
    public $street;
    public $house_number;
    public $city;
    public $postal_code;
    public $country;
    // There are three levels of visibility in PHP: public, protected and private.
    // For now, public means "accessible from outside the object"
    // and protected means "not accessible from outside". 
}


$my_address = new Address(); // new instance of this class

var_dump($my_address);

// set values manually to the properties of the $my_address class instance.
$my_address->street = "Main Street";
$my_address->house_number = 42;
$my_address->city = "Some Town";
$my_address->postal_code = "12345";
$my_address->country = "Far Far Away";

//////////////////// CLASS METHODS ///////////////////////////////////////////

// instead of assigning values manually, we could define a class method
// that will set the required values to the correct properties.
class Address2
{
    public $street;
    public $house_number;
    public $city;
    public $postal_code;
    public $country;

    public function set($street, $house_number, $city, $postal_code, $country) // list of properties as method arguments
    {
        $this->street = $street; // set the property for this object
        $this->house_number = $house_number;
        $this->city = $city;
        $this->postal_code = $postal_code;
        $this->country = $country;
    }
}

$my_address = new Address2(); // new instance of this class

$my_address->set("Main Street", 42, "Some Town", 12345, "Far Far Away");
// assign values to properties automatically using the set() method

var_dump($my_address);

////////////////// CONSTRUCTS ////////////////////////////////

// instead of creating a special method for assigning values, we can
// create a construct which allows the properties to be assigned directly
// as arguments of a new class instance, instead of arguments of a method.
//
// If a class has a method with the exact name __construct, it will
// be called when the object is created with the new operator.

class Address3
{
    public $street;
    public $house_number;
    public $city;
    public $postal_code;
    public $country;

    public function __construct($street, $house_number, $city, $postal_code, $country)
    {
        $this->street = $street;
        $this->house_number = $house_number;
        $this->city = $city;
        $this->postal_code = $postal_code;
        $this->country = $country;
    }
}

$my_address = new Address3("Main Street", 42, "Some Town", 12345, "Far Far Away");

var_dump($my_address);
