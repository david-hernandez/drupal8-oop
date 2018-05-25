<?php

/**
 * Class Animal
 */
class Animal {

  protected $species;

  public function __construct() {
    $this->setSpecies('Dog');
  }

  public function setSpecies($species) {
    $this->species = $species;
  }

  public function getSpecies() {
    return $this->species;
  }

}

/**
 * Class Cat
 */
class Cat extends Animal {

  public function setSpecies($species) {
    // We'll ignore the species and set Cat directly.
    $this->species = 'Cat';
  }

}

$my_animal = new Animal;
print "I have a " . $my_animal->getSpecies() . "\n";

$my_cat = new Cat;
print "I have a " . $my_cat->getSpecies() . "\n";

/**
 * Class Country
 */
class Country {

  protected function text() {
    return "I am a country";
  }

  public function getText() {
    return $this->text();
  }

}

/**
 * Class City
 */
class City extends Country {

  protected function text() {
    return parent::text() . " and " . "I am a city";
  }

}

$location = new City;
print $location->getText() . "\n";