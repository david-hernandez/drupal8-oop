<?php

namespace Classes\Traits;

/**
 * We can reuse this functionality in multiple places.
 *
 * Trait OrganismUtilitiesTrait
 * @package Classes\Traits
 */
trait OrganismUtilitiesTrait {

  /**
   * Retrieve the kingdom nme.
   *
   * @return string
   */
  public function getKingdom() {
    return $this->kingdom;
  }

}