<?php

/**
 * Class Animal
 */
class Animal {

  protected $species;

  // Constructor method.
  public function __construct($species) {
    $this->species = $species;
  }

  public function getSpecies() {
    return $this->species;
  }

}

// We can now pass the name of the species directly when the object is created.
$my_animal = new Animal('Cat');

print "I have a " . $my_animal->getSpecies() . "\n";