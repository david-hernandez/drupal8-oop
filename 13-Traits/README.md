# Traits

http://php.net/manual/en/language.oop5.traits.php

A trait is like a class, but it's not meant to be instantiated, or extended, or anything like that. It is meant to be 
included. When you have methods you want to reuse, and not copy and paste them all over the place, you can put them in 
a trait and include the trait in your class. Since they are similar to classes, and not just a file you dump functions 
in, they gain all the benefits of namespacing and autoloading. That makes it much easier to find them and include them.

Let's take the `getKingdom()` method from the abstract class example and put it in a trait.

```$xslt
trait UtilitiesForKingdoms {
 
    public function getKingdom() {
        return $this->kingdom;
    }
 
}
```

Then, update the classes to use the trait. We add a `use` statement for including the trait, just like we would for a 
class. The difference here is that for a trait we put the `use` inside the class, not outside of it. 

```$xslt
class Animal extends Kingdom {
 
  use UtilitiesForKingdoms;
 
  protected $kingdom = 'Animal';
 
  protected $number_of_legs;
 
  public function setNumberOfLegs($number) {
    $this->number_of_legs = $number;
  }
 
  public function getNumberOfLegs() {
    return $this->number_of_legs;
  }
 
}

class Plant extends Kingdom {
 
  use UtilitiesForKingdoms;
 
  protected $kingdom = 'Plant';
 
  protected $flowering = TRUE;
 
  public function setFlowering($flowering) {
    $this->$flowering = $flowering;
  }
 
  public function getFlowering() {
    return $this->flowering;
  }
 
}
```