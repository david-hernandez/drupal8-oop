<?php

/**
 * Autoloader file.
 *
 * This will automatically include the class files. They will all be placed in the 'src/Classes' directory.
 * We are using a static method in a class instead of a plain function.
 */
class Autoloader {

  /**
   * $className should contain things like 'Classes\Organisms\Animal'.
   *
   * @param $class_name
   * @return bool
   */
  static public function loader($class_name) {

    /**
     * Convert the class name into a directory structure and add .php to the end so we have a real file.
     * $filename will look like '/var/www/18-Putting-it-together/src/Classes/Organisms/Animal.php'.
     * We don't need to include 'src' anywhere because the autoloader is in the 'src' directory.
     */
    $filename = __DIR__ . "/" . str_replace("\\", '/', $class_name) . ".php";

    if (file_exists($filename)) {
      include($filename);
      if (class_exists($class_name)) {
        return TRUE;
      }
    }
    return FALSE;
  }

}

// Register the autoloader with PHP.
spl_autoload_register('Autoloader::loader');