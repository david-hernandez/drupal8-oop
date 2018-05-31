<?php

/**
 * Interface LivingThing
 */
interface LivingThing {

  public function setSpecies($species);

  public function getSpecies();

}

/**
 * Class Animal
 */
class Animal implements LivingThing {

  protected $species;
  protected $number_of_legs;

  public function __construct($species) {
    $this->setSpecies($species);
  }

  // Required by the interface.
  public function setSpecies($species) {
    $this->species = $species;
  }

  // Required by the interface.
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

/**
 * Class Plant
 */
class Plant implements LivingThing {

  protected $species;
  protected $flowering = TRUE;

  public function __construct($species) {
    $this->setSpecies($species);
  }

  // Required by the interface.
  public function setSpecies($species) {
    $this->species = $species;
  }

  // Required by the interface.
  public function getSpecies() {
    return $this->species;
  }

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
  print "This is a " . $thing->getSpecies() . "\n";
  return TRUE;
}

/**
 * Class testLivingThing
 */
class TestLivingThing implements LivingThing {

  public function setSpecies($species) {
    // Do nothing, because we don't need this for the test.
  }

  public function getSpecies() {
    // We don't actually need any of the functionality of the other classes, so returning a hard-coded value is fine.
    return 'Test Species';
  }

}

$test_living_thing = new TestLivingThing;

// This is not a real test. It's just to give you a rough idea that test classes are useful.
if (display_living_thing($test_living_thing)) {
  print "The test message printed\n";
}