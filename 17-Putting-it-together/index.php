<?php

// Use statements for the classes we directly reference in this file. The autoloader will find them.
use Classes\Services\Organism;
use Classes\Services\Renderer;

// Import the autoloader.
require_once("src/Autoloader.php");

/**
 * Example 1.
 *
 * Go through the array of ids and load them one at a time.
 */
$ids = [123, 333, 1543];
foreach ($ids as $id) {
  $organism = Organism::load($id);
  print $organism->getDescription();
}

/**
 * Example 2.
 *
 * In one shot load multiple organisms.
 */
$ids = [333, 19];
$list1 = Organism::loadMultiple($ids);
foreach ($list1 as $organism) {
  print $organism->getDescription();

}

/**
 * Example 3.
 *
 * Load all organisms. We don't need to supply any ids. We also use the renderer class to produce a more styled result.
 */
$list2 = Organism::loadAll();
foreach ($list2 as $organism) {
  Renderer::renderOrganism($organism);
}