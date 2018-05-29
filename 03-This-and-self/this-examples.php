<?php

/**
 * Class Animal
 */
class Animal {

  // Protected property. It can only be accessed within the class.
  protected $species;

  public function setSpecies($species) {
    // $this gives us access to the property and set its value.
    $this->species = $species;
  }

  public function getSpecies() {
    // $this lets us retrieve the property's value.
    return $this->species;
  }

}

$my_animal = new Animal;
$my_animal->setSpecies('Cat');

// This will cause an error. The property is protected.
// print $my_animal->species;
print "My animal is a " . $my_animal->getSpecies() . "\n";

/**
 * Class Cat
 */
class Cat extends Animal {

  public function setCat() {
    // $this also gives us access to members of the parent class.
    $this->species = 'Cat';
  }

}

$my_cat = new Cat;
$my_cat->setCat();

print "I have a " . $my_cat->getSpecies() . "\n";