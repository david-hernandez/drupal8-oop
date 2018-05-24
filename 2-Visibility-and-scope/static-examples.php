<?php

/**
 * Class Animal
 */
class Animal {

  // Property.
  private $number_of_legs = 4;

  // Method.
  private function setSpecies($species) {
    // Do some stuff.
  }

  public function getAnimalLegs() {
    return $this->number_of_legs;
  }

}

$my_animal = new Animal;

// We can access the public method, which internally accesses the private property.
$leg_count = $my_animal->getAnimalLegs();

print "My animal has " . $leg_count . " legs\n";

/**
 * The lines below will result in errors. Try uncommenting them and trying.
 */
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
    // This won't work now. We can't access $number_of_legs when it is declared private in Animal.
    // return $this->number_of_legs;
  }

}
