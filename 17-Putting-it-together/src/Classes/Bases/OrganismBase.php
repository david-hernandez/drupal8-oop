<?php

namespace Classes\Bases;

use Classes\Interfaces\OrganismInterface;

/**
 * Class OrganismBase
 * @package Classes\Bases
 */
abstract class OrganismBase implements OrganismInterface {

  /**
   * The organism's unique id. Will store an integer.
   */
  protected $id;

  /**
   * The organism's species name. Will store a string.
   */
  protected $species;

  /**
   * OrganismBase constructor.
   * @param $id
   *  Unique id for the organism. Must be an integer.
   * @param $species
   *  The species name.
   */
  public function __construct($id, $species) {
    $this->setId($id);
    $this->setSpecies($species);
  }

  /**
   * Retrieve the unique id number.
   *
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Retrieve the species name.
   *
   * @return mixed
   */
  public function getSpecies() {
    return $this->species;
  }

  /**
   * Set the unique id when a new organism is constructed.
   *
   * @param $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * Set the species name.
   *
   * @param $species
   */
  public function setSpecies($species) {
    $this->species = $species;
  }

}