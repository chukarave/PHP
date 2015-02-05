<?php

require "vendor/autoload.php";
// where to find dependencies. autoload.php contains instructions for PHP 
// on how to find Silex and all other dependencies.

$app = new Silex\Application();
// new object from class "application", found within the namespace Silex
// the new class instance can accept arguments. 

$app->get("/", function(){
    return "Hello world!";
});
// get() is a method of the application object.
// the -> operator adresses methods and properties of specific objects.
// ("/",  tells our application which URLs to respond to. in this case 
// the URL is only /.

$app->run();
// run the application
