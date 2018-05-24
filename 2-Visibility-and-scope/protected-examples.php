<?php

/**
 * Class Animal
 */
class Animal {

  // Property.
  protected $number_of_legs = 4;

  // Method.
  protected function setSpecies($species) {
    // Do some stuff.
  }

}

/**
 * The lines below, except for creating the new object, will result in errors. Try uncommenting them and trying.
 */
// $my_animal = new Animal;
// $my_animal->setSpecies('Cat');
// $leg_count = $my_animal->number_of_legs;
// print "My animal has " . $leg_count . " legs\n";

/**
 * Class Mammal
 *
 * This class extends the Animal class. It will inherit things from it.
 */
class Mammal extends Animal {

  public function getMammalLegs() {
    // We'll talk about $this in a later section of the tutorial, but it gives us access to things Mammal inherited.
    return $this->number_of_legs;
  }

}

/**
 * The lines below will result in errors. Try uncommenting them and trying.
 */
// $my_mammal = new Mammal;
// $mammal_leg_count = $my_mammal->number_of_legs;
// print "My mammal has " . $leg_count . " legs\n";

/**
 * These lines should work.
 */
$my_mammal = new Mammal;
$mammal_leg_count = $my_mammal->getMammalLegs();
print "My mammal has " . $mammal_leg_count . " legs\n";