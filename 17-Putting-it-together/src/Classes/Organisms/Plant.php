<?php

namespace Classes\Organisms;

use Classes\Bases\OrganismBase;
use Classes\Traits\OrganismUtilitiesTrait;

/**
 * Class Plant
 * @package Classes\Organisms
 */
class Plant extends OrganismBase {

  /**
   * Include the trait that gives is the getKingdom() method.
   */
  use OrganismUtilitiesTrait;

  /**
   * We can hard-code the kingdom name as a default value because it shouldn't change.
   */
  protected $kingdom = 'Plant';

  protected $flowering = TRUE;

  /**
   * Plant constructor.
   *
   * This will override the constructor from OrganismBase, but we still run it with the parent:: keyword to that it will
   * set the id and species. No sense duplicating that functionality.
   *
   * @param $id
   * @param $species
   * @param $flowering
   */
  public function __construct($id, $species, $flowering) {
    // We let the parent OrganismBase set the species. We get the full $organism from the factory, but the base class
    // doesn't care about the factory.
    parent::__construct($id, $species);

    $this->flowering = $flowering;
  }

  /**
   * This static method will return an instance of itself (Plant) while providing the correct arguments.
   *
   * @param array $organism
   * @return static
   */
  public static function create(array $organism) {
    $id = $organism['Id'];
    $species = $organism['Species'];
    $flowering = $organism['Flowering'];

    // Late static binding. These pass to the constructor. Look at the factory.
    return new static($id, $species, $flowering);
  }

  /**
   * @param $flowering
   */
  public function setFlowering($flowering) {
    $this->$flowering = $flowering;
  }

  /**
   * @return bool
   */
  public function getFlowering() {
    return $this->flowering;
  }

  /*
   * This will return description text.
   *
   * @return string
   */
  public function getDescription() {
    if ($this->flowering) {
      $text = "does";
    } else {
      $text = "does not";
    }
    return "It " . $text . " flower.\n";
  }

}