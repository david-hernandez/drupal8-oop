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

/**
 * Class Organism
 */
class Organism {

  // This class and its static create method serve as the factory that creates other classes. We could simplify this
  // and just return "new $kingdom($species)" but let's pretend we're doing something more complicated.
  public static function create($kingdom, $species) {
    switch ($kingdom) {
      case 'Animal':
        $organism = new Animal($species);
        break;
      case 'Plant':
        $organism = new Plant($species);
      default:
        // Probably throw an error here.
    }
    return $organism;
  }

}

$organisms = [
  [
    'Kingdom' => 'Animal',
    'Species' => 'Cat',
  ],
  [
    'Kingdom' => 'Plant',
    'Species' => 'Fern',
  ],
];

$array_of_objects = [];
foreach ($organisms as $organism) {
  $array_of_objects[] = Organism::create($organism['Kingdom'], $organism['Species']);
}

foreach ($array_of_objects as $object) {
  display_living_thing($object);
}

function display_living_thing(LivingThing $thing) {
  print "This is a " . $thing->getSpecies() . ". It belongs to the " . $thing->getKingdom() . " kingdom.\n";
}