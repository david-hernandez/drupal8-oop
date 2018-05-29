<?php

// Requiring or including the file directory is to old, simple way, and isn't very flexible.
// require_once('Animal.php');

// This is a built-in PHP function that will automatically include the class file.
// If you want to try the require_once() line above, comment out this code below.
spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

$my_animal = new Animal('Cat');
$my_animal->setNumberOfLegs(4);

print "I have a " . $my_animal->getSpecies() . " with " . $my_animal->getNumberOfLegs() . " legs\n";
