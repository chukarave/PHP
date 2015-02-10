<?php

// file_put_contents
// writes strings into a file.
// in order to not overwrite existing content
// use FILE_APPEND as a third argument.

$file = 'php_file_functions.php';
$content = '### this is a test string ###';
file_put_contents($file, $content, FILE_APPEND);
### this is a test string ###


/// LOCK_EX as an additional argument
// locks the file from writing in the 
// same time, though not from being read.

// The same effect as file_put_contents 
// can be achieved by calling fopen()
// fwrite() and fclose() successively on a file:


$str = '### this string was written using fopen, fwrite and fclose ###';

$p = fopen($file, 'a');
fwrite($p, $str);
fclose($p);
### this string was written using fopen, fwrite and fclose ###

?>

