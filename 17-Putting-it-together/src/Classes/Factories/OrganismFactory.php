<?php

namespace Classes\Factories;

/**
 * Class OrganismFactory
 *
 * This will build organisms, regardless of what kingdom they are. It acts as a helper so we don't have to know what
 * class each organism type uses.
 *
 * @package Classes\Factories
 */
class OrganismFactory {

  /**
   * This static create method serves as the factory that creates other classes.
   *
   * @param array $organism
   * @return mixed
   */
  public static function create(array $organism) {
    // We specify the namespace here because we don't have good ways to retrieve it. If this were a real application,
    // like Drupal, we'd have this organisms registered somewhere. That is done with the router, plugin manager, etc.
    $class = "\\Classes\\Organisms\\" . $organism['Kingdom'];
    $instantiated_organism = $class::create($organism);
    return $instantiated_organism;
  }

}