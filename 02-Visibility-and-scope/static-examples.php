<?php

/**
 * Class DateUtility
 *
 * A class we will use without instantiating an object.
 */
class DateUtility {

  public static function getTodaysDate() {
    date_default_timezone_set('UTC');
    return date('Y-m-d');
  }

}

// Use the class and method in it without instantiating an object.
$date = DateUtility::getTodaysDate();

print "Today's date is: " . $date . "\n";
