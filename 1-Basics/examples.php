<?php

/**
 * Class Animal
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

// Accessing a method in the object with the arrow operator.
$my_animal->setSpecies('Cat');

// Accessing a property in the object.
$leg_count = $my_animal->number_of_legs;

print "My animal has " . $leg_count . " legs\n";

/**
 * Class Mammal
 *
 * This class extends the Animal class. It will inherit things from it.
 */
class Mammal extends Animal {
  // There is nothing in here.
}

// Instantiating a new object. This time of class Mammal.
$my_mammal = new Mammal;

// Accessing a property in the object, which is inherited from the parent class.
$mammal_leg_count = $my_mammal->number_of_legs;

print "My mammal has " . $mammal_leg_count . " legs\n";


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