<?php

function print_array(array $values) // specifiy array as type of expected argument.
{
    foreach($values as $value) {
        echo $value . PHP_EOL;
    }
}

class Foo
{
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

function print_foo(Foo $f) // $f has to be an instance of class Foo
{
    echo $f->getName();
}

$a = [1, 2, 3, 4];
$b = new Foo("some_name\n");

print_array($a);




print_foo($b);

print_array("this is a string"); // will result in a fatal error

#############################################
#        Default values for arguments       #
#############################################


function print_array1(array $values, $reverse = false)
{
    // if reverse is set to true, reverse order of array elements.
    if ($reverse) {
        $print_values = array_reverse($values);
    } else {
        $print_values = $values;
    }

    foreach ($print_values as $value) {
        echo $value . PHP_EOL;
    }
}


print_array([1, 2, 3, 4], true);
/* prints:
4
3
2
1
*/

?>
