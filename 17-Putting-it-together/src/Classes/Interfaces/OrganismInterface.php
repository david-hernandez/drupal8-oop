<?php

namespace Classes\Interfaces;

/**
 * Interface OrganismInterface
 */
interface OrganismInterface {


  public function getDescription();

  /**
   * Retrieve the unique id number.
   *
   * @return mixed
   */
  public function getId();

  /**
   * Retrieve the kingdom nme.
   *
   * @return string
   */
  public function getKingdom();

  /**
   * Retrieve the species name.
   *
   * @return mixed
   */
  public function getSpecies();

  /**
   * Set the unique id when a new organism is constructed.
   *
   * @param $id
   */
  public function setId($id);

  /**
   * Set the species name.
   *
   * @param $species
   */
  public function setSpecies($species);

}