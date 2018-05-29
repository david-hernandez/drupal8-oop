<?php

/**
 * Class Animal
 */
class Animal {

  protected $species;
  protected $number_of_legs;

  public function __construct($species) {
    $this->setSpecies($species);
  }

  public function setSpecies($species) {
    $this->species = $species;
  }

  public function getSpecies() {
    return $this->species;
  }

  public function setNumberOfLegs($number) {
    $this->number_of_legs = $number;
  }

  public function getNumberOfLegs() {
    return $this->number_of_legs;
  }

}