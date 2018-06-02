<?php

namespace Classes\Services;

use Classes\Factories\OrganismFactory;
use Classes\Interfaces\OrganismInterface;

/**
 * Class Organism
 *
 * This will act as a service to load organisms. Since there is no storage for this example app, they've been placed in
 * a static array for retrieval.
 *
 * @package Classes\Services
 */
class Organism {

  /**
   * I'm duplicating the array id as 'Id' because I don't feel like doing anything fancy to search for the id.
   *
   * @var array
   */
  protected static $organisms = [
    123 => ['Id' => 123, 'Kingdom' => 'Animal', 'Species' => 'Cat', 'Legs' => 4, 'Food' => 'meow mix'],
    333 => ['Id' => 333, 'Kingdom' => 'Animal', 'Species' => 'Eagle', 'Legs' => 2, 'Food' => 'fish'],
    1543 => ['Id' => 1543, 'Kingdom' => 'Plant', 'Species' => 'Fern', 'Flowering' => FALSE],
    19 => ['Id' => 19, 'Kingdom' => 'Plant', 'Species' => 'Rose', 'Flowering' => TRUE],
  ];

  /**
   * Load one organism when given the id.
   *
   * @param $id
   * @return OrganismInterface|bool
   */
  public static function load($id) {
    if (is_int($id)) {
      return OrganismFactory::create(static::$organisms[$id]);
    }
    return FALSE;
  }

  /**
   * Load all available organisms.
   *
   * @return array
   */
  public static function loadAll() {
    $list = [];
    foreach (static::$organisms as $organism) {
      $list[] = OrganismFactory::create($organism);
    }
    return $list;
  }

  /**
   * Load multiple organisms when given an array of ids.
   *
   * @param array $ids
   * @return array
   */
  public static function loadMultiple(array $ids) {
    $list = [];
    foreach ($ids as $id) {
      if (is_int($id)) {
        $list[] = OrganismFactory::create(static::$organisms[$id]);
      }
    }
    return $list;
  }

}