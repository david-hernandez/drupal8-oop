<?php

// This is a built-in PHP function that will automatically include the class file.
spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

$my_creature = 'Cat';

// This line should give you an error, like this "Fatal error: Call to a member function getSpecies() on string in..."
// display_creature($my_creature);

// This should work.
$my_animal = new Animal('Cat');
display_creature($my_animal);

function display_creature($creature) {
  $species = $creature->getSpecies();
  print "This is a " . $species . " \n";
}

// This will give a different error. "Catchable fatal error: Argument 1 passed to display_creature_again() must be an instance of Animal, string given..."
// display_creature_again($my_creature);

// This should work.
display_creature_again($my_animal, 3);
// Try changing the 3 to text and see if you get an error.

// You will need PHP 7 for the 'int' typing to work. If you are on an older version, remove it.
function display_creature_again(Animal $creature, int $count) {
  $species = $creature->getSpecies();
  $i = 0;
  while ($i++ < $count) {
    print "This is also a " . $species . " \n";
  }
}

$some_string = "Hello, World!";
// See what happens when you change the count to 2. You should get a warning like "Warning: Invalid argument supplied for foreach()..."
$count = 1;

do_work($some_string, $count);

function do_work($should_be_an_array, $count) {
  if ($count > 1) {
    foreach ($should_be_an_array as $one_item) {
      print "What's in this item: " . $one_item . "\n";
    }
  }
  else {
    print "You only had one thing here. \n";
  }
}