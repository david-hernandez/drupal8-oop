<?php

/**
 * Class DateUtility
 *
 * A class we will use without instantiating an object.
 */
class DateUtility {

  protected static $label = "Today's date is: ";

  public static function getTodaysDate() {
    date_default_timezone_set('UTC');
    $date = date('Y-m-d');

    // self is used to access the static property.
    $text = self::$label;

    return $text . $date;
  }

}

// Use the class and method in it without instantiating an object.
$date = DateUtility::getTodaysDate();

print $date . "\n";
