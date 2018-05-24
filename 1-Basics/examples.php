<?php

/**
 * Class Animal.
 */
class Animal {

  // Property.
  public $number_of_legs = 4;

  // Method.
  function setSpecies($species) {
    // Do some stuff.
  }

}

// Instantiating a new object.
$my_animal = new Animal;

// Accessing a method within the object, using the arrow operator.
$my_animal->setSpecies('Cat');

// Accessing a property within the object.
$leg_count = $my_animal->number_of_legs;

print "My animal has " . $leg_count . " legs\n";

/**
 * Class UtilityClassOfSomeSort
 *
 * A class we will use without instantiating an object.
 */
class UtilityClassOfSomeSort {

  public static function getTodaysDate() {
    date_default_timezone_set('UTC');
    return date('Y-m-d');
  }

}

// Use the class and method in it without instantiating an object.
$date = UtilityClassOfSomeSort::getTodaysDate();

print "Today's date is: " . $date . "\n";