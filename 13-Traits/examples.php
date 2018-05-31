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
 * Trait UtilitiesForKingdoms
 */
trait UtilitiesForKingdoms {

  public function getKingdom() {
    return $this->kingdom;
  }

}

/**
 * Class Animal
 */
class Animal extends Kingdom {

  // This class will now be able to provide getKingdom().
  use UtilitiesForKingdoms;

  // This sets the Kingdom name, which the method in the trait will return.
  protected $kingdom = 'Animal';

  protected $number_of_legs;

  public function setNumberOfLegs($number) {
    $this->number_of_legs = $number;
  }

  public function getNumberOfLegs() {
    return $this->number_of_legs;
  }

}

/**
 * Class Plant
 */
class Plant extends Kingdom {

  // This class will now be able to provide getKingdom().
  use UtilitiesForKingdoms;

  // This sets the Kingdom name, which the method in the trait will return.
  protected $kingdom = 'Plant';

  protected $flowering = TRUE;

  public function setFlowering($flowering) {
    $this->$flowering = $flowering;
  }

  public function getFlowering() {
    return $this->flowering;
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