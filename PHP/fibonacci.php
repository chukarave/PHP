<?php // start every php document with this tag

function fibonacci($count)   // function definition
{
    if ($count < 0) { // control flow if condition
        $count = 0; // variable definition. all variables start with $
    }
// variables inside functions are only visible inside the function.
    $n1 = 0;
    $n2 = 1;
    $n = 1;
    $numbers = [];

    for ($i = 0; $i < $count; $i++) { // control flow for loop. the $ sign is typed every time a variable is typed.
        $numbers[] = $n;
        $n = $n1 + $n2;
        $n1 = $n2;
        $n2 = $n;
    }

    return $numbers;
}

echo implode(fibonacci(10), ", ") . PHP_EOL;
