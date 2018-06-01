<?php

/**
 * Class Foo
 */
class Foo {

  public $var1;

  public function __construct($var1) {
    $this->var1 = $var1;
  }

  public static function create(array $food) {
    return new static($food[0]);
  }

  public function printContents() {
    print "I have a " . $this->var1 . "\n";
  }

}

/**
 * Class Bar
 */
class Bar {

  public $var1;
  public $var2;

  public function __construct($var1, $var2) {
    $this->var1 = $var1;
    $this->var2 = $var2;
  }

  public static function create(array $food) {
    return new static($food[2], $food[3]);
  }

  public function printContents() {
    print "I have a " . $this->var1 . " and a " . $this->var2 . "\n";
  }

}

$food = ['banana', 'pear', 'steak', 'pie'];

$foo = Foo::create($food);
$foo->printContents();

$bar = Bar::create($food);
$bar->printContents();