<?php

/**
 * Interface LivingThing
 */
interface LivingThing {

  public function setSpecies($species);

  public function getSpecies();

  // Notice that Kingdom does not have this method. Abstract classes pass on requirements to their children.
  public function getKingdom();

}

/**
 * Class Kingdom
 */
abstract class Kingdom implements LivingThing {

  protected $species;

  public function __construct($species) {
    $this->setSpecies($species);
  }

  public function setSpecies($species) {
    $this->species = $species;
  }

  public function getSpecies() {
    return $this->species;
  }

}

/**
 * Class Animal
 */
class Animal extends Kingdom {

  protected $number_of_legs;

  public function setNumberOfLegs($number) {
    $this->number_of_legs = $number;
  }

  public function getNumberOfLegs() {
    return $this->number_of_legs;
  }

  // This is a requirement from the interface.
  public function getKingdom() {
    return 'Animal';
  }

}

/**
 * Class Plant
 */
class Plant extends Kingdom {

  protected $flowering = TRUE;

  public function setFlowering($flowering) {
    $this->$flowering = $flowering;
  }

  public function getFlowering() {
    return $this->flowering;
  }

  // This is a requirement from the interface.
  public function getKingdom() {
    return 'Plant';
  }

}

$animal = new Animal('Cat');
$animal->setNumberOfLegs(4);
display_living_thing($animal);

$plant = new Plant('Fern');
$plant->setFlowering(FALSE);
display_living_thing($plant);

function display_living_thing(LivingThing $thing) {
  print "This is a " . $thing->getSpecies() . ". It belongs to the " . $thing->getKingdom() . " kingdom.\n";
}