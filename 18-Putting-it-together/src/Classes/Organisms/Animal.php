<?php

namespace Classes\Organisms;

use Classes\Bases\OrganismBase;
use Classes\Traits\OrganismUtilitiesTrait;

/**
 * Class Animal
 * @package Classes\Organisms
 */
class Animal extends OrganismBase {

  /**
   * Include the trait that gives is the getKingdom() method.
   */
  use OrganismUtilitiesTrait;

  /**
   * We can hard-code the kingdom name as a default value because it shouldn't change.
   */
  protected $kingdom = 'Animal';

  protected $food;
  protected $number_of_legs;

  /**
   * Animal constructor.
   *
   * This will override the constructor from OrganismBase, but we still run it with the parent:: keyword to that it will
   * set the id and species. No sense duplicating that functionality.
   *
   * @param $id
   * @param $species
   * @param $legs
   * @param $food
   */
  public function __construct($id, $species, $legs, $food) {
    // We let the parent OrganismBase set the species. We get the full $organism from the factory, but the base class
    // doesn't care about the factory.
    parent::__construct($id, $species);

    $this->number_of_legs = $legs;
    $this->food = $food;
  }

  /**
   * This static method will return an instance of itself (Animal) while providing the correct arguments.
   *
   * @param array $organism
   * @return static
   */
  public static function create(array $organism) {
    $id = $organism['Id'];
    $species = $organism['Species'];
    $legs = $organism['Legs'];
    $food = $organism['Food'];

    // Late static binding. These pass to the constructor. Look at the factory.
    return new static($id, $species, $legs, $food);
  }

  /**
   * This will return description text.
   *
   * @return string
   */
  public function getDescription() {
    $legs_text = "It has " . $this->getNumberOfLegs() . " legs.";
    $food_text = " It likes to eat " . $this->getFavoriteFood() . ".";
    return $legs_text . $food_text . "\n";
  }

  /**
   * @return string
   */
  public function getFavoriteFood() {
    return $this->food;
  }

  /**
   * @return integer
   */
  public function getNumberOfLegs() {
    return $this->number_of_legs;
  }

  /**
   * @param $number
   */
  public function setNumberOfLegs($number) {
    $this->number_of_legs = $number;
  }

}