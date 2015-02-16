<?php

class Foo 
{
    public function a_public_method()
    {
        echo "PUBLIC!!" . PHP_EOL;
    }

    protected function a_protected_method()
    {
        echo "PROTECTED!!" . PHP_EOL;
    }

    private function a_private_method()
    {
        echo "PRIVATE!!" . PHP_EOL;
    }

    public function foo_test()
    {
        $this->a_public_method();
        $this->a_protected_method();
        $this->a_private_method();
    }
}

class Bar extends Foo
{
    public function bar_test()
    {
       $this->a_public_method();
       $this->a_protected_method();
       $this->a_private_method();
    }
    
    // this function takes a class instance
    // as a variable and calls its below mentioned
    // methods. 
    // The private method will not be visible in this case.
    public function external_test($external)
    {
        $external->a_public_method();
        $external->a_protected_method();
        $external->a_private_method();
    }
}

$foo = new Foo(); // new instance of Foo
$bar = new Bar(); // new instance of Bar which inherits Foo.

// Public methods are always visible:
$foo->a_public_method();
// prints "PUBLIC!!"

// Protected methods are not visible from the outside:
$foo->a_protected_method();
// "Fatal error: Call to protected method
//  Foo::a_protected_method() from context ''"

// Objects can see all methods in their class:
$foo->foo_test();
// PUBLIC!!
// PROTECTED!!
// PRIVATE!!


// Although Bar inherits from Foo,
// $bar can't see private methods in
// Foo. This is the difference b/w 
// protected and private:

$bar->bar_test();
// PUBLIC!!
// PROTECTED!!
// PHP Fatal error:  Call to private method
// Foo::a_private_method() from context 'Bar'


// Object's can see each other's protected
// methods only if their classes have a
// commin ancestor. 
// They can't see private methods.

$bar->external_test($foo);
// PUBLIC!!
// PROTECTED!!
// PHP Fatal error:  Call to private method
// Foo::a_private_method() from context 'Bar'


?>
