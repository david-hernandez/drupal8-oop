<?php

namespace Classes\Services;

use Classes\Interfaces\OrganismInterface;

/**
 * Use this service to render each organism. Since the interface is type hinted, we know it will only be sent an object
 * that has those methods.
 *
 * Class Renderer
 * @package Classes\Services
 */
class Renderer {

  /**
   * Render the organism as a text block.
   *
   * @param OrganismInterface $organism
   */
  public static function renderOrganism(OrganismInterface $organism) {
    print "\n" . $organism->getSpecies() . "\n";
    print "-----------------------------------\n";
    print "ID: " . $organism->getId() . ", Kingdom: " . $organism->getKingdom() . "\n";
    print "Description: " . $organism->getDescription();
  }

}