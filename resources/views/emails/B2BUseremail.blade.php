<?php

use App\Http\Controllers\api;

$root = $_SERVER['DOCUMENT_ROOT'];
$file = file_get_contents($root . '/mailers/b2buseremail.html', 'r');

$file = str_replace('#Mobile', $data['mobile'], $file);
$file = str_replace('#Password', $data['Password'], $file);
$file = str_replace('#contact_person', $data['contact_person'], $file);

echo $file;

// exit();

?>
