<?php

$arr = SplFixedArray::fromArray([1, 2, 3, 4, 5]);

// print the current element of the array
echo current($arr) . PHP_EOL; //1
// print the next element of the array
echo next ($arr) . PHP_EOL; //2
echo current($arr) . PHP_EOL; //2
// print the last element of the array
echo end($arr) . PHP_EOL; //5

// loop over the array
foreach ($arr as $value) {
    echo $value . PHP_EOL;
}
/* 1
 * 2
 * 3
 * 4
 * 5
 */

// set the internal pointer of the array to its first element.
reset($arr);

echo current($arr) . PHP_EOL; // 1

// The object operator -> is used when you
// want to call a method on an instance
// or access an instance property.
// in this case we call the count method
// on an SplFixedArray instance.
echo $arr->count() . "\n"; // 5

// print the number of elements in the array.
echo count($arr) . "\n"; // 5

// call the getSize method on the array.
echo $arr->getSize() . "\n"; // 5

// array_map allows you to implement
// any array method on a given array.
// map returns a new array with the
// altered array values as a result.
$a = array('a', 'b', 'c');
$b = array_map("mb_strtoupper", $a);
var_dump($b);
/*
array(3) {
  [0]=>
  string(1) "A"
  [1]=>
  string(1) "B"
  [2]=>
  string(1) "C"
}
 */


// sort() without any sorting variable
// sorts array elements alphabetically
// it is not recommended to use with
// mixed type arrays since results
// are often unpredictable.
$animals = array('dog', 'bear', 'cow');
sort($animals);
foreach($animals as $key => $val) {
    echo $key . " = " . $val . "\n";
}
/*
0 = bear
1 = cow
2 = dog
 */

// ksort() is the same only by key

$arrg = array('c' => 'silver', 'e' => 'red', 'a' => 'yellow');
ksort($arrg);
foreach ($arrg as $key => $val) {
    echo "$key = $val\n";
}
/*
a = yellow
c = silver
e = red
 */

// array_filter takes a condition and
// implements it on an array.
// it returns an array of all elements
// for which the implementation
// resulted in "true".
$arr = array(1, 2, 3, 4, 5, 6);

// this function checks if a number is even
function even($var) {
    if (($var % 2) == 0) {
      return true;
    }
}

var_dump(array_filter($arr, "even"));

/*
    array(3) {
    [1]=>
    int(2)
    [3]=>
    int(4)
    [5]=>
    int(6)
    }
*/


// array_key_exists checks if
// a certain key exists in an array.

$meow = array('cat' => 'meow', 'bla' => 'nobla', 'tee' => 'hee');

if (array_key_exists('bla', $meow)) {
    echo "Bla exists in array\n";
}

// Bla exists in array


// array_merge merges two arrays into one.

$arr1 = array('apple', 'banana', 'grapes');
$arr2 = array('red', 'yellow', 'purple');
var_dump(array_merge($arr1, $arr2));

/*
    [0]=>
    string(5) "apple"
    [1]=>
    string(6) "banana"
    [2]=>
    string(6) "grapes"
    [3]=>
    string(3) "red"
    [4]=>
    string(6) "yellow"
    [5]=>
    string(6) "purple"
 */

// array_slice slices a part of an array

$arr1 = array('apple', 'banana', 'grapes', 'cherries', 'pineapple');
var_dump(array_slice($arr1, 1, 3));

/*
array(3) {
  [0]=>
  string(6) "banana"
  [1]=>
  string(6) "grapes"
  [2]=>
  string(8) "cherries"
}
 */

// explode separates a string
// into an array of strings,
// separated by a specified delimiter

$bla = 'bla*bli*blo*blu';
var_dump(explode("*", $bla));

/*
    array(4) {
        [0]=>
            string(3) "bla"
            [1]=>
            string(3) "bli"
            [2]=>
            string(3) "blo"
            [3]=>
            string(3) "blu"
    }
 */

// implode does the opposite -
// returns a string from an
// array of elements.

$num = array(1, 2, 3, 4);
var_dump(implode("--", $num));

// string(10) "1--2--3--4"

?>
