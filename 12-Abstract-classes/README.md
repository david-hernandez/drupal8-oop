# Abstract Classes

http://php.net/manual/en/language.oop5.abstract.php

I keep harping on the point that things are named the way they are for a reason. Well, what does "abstract" mean? One 
definition means something conceptual, theoretical, not quite real. Another means extracted, removed, separated. 
Abstract classes and methods are a little of both.

Like an interface, an abstract class cannot be used directly. It straddles the line between something completely 
conceptual, like an interface, and something very real, like an object. In practice, abstract classes often implement 
interfaces (though they don't have to,) and act as "base" classes for you to extend. They provide a level of 
functionality that an interface cannot, but by being abstract, you cannot use them directly. This is intentional. It 
enforces a common structure, and promotes code reuse. Important factors in framework and application design.

If we use building a house as an example:

* An abstract class is a particular architectural home design, like a Cape Cod; its key features, methods 
for designing, general specifications, etc. For example, standards for building the gable roof and central fireplace 
that all capes have. But it doesn't tell you how to build a specific house.
* The regular class is the blue print for one specific design of a Cape Cod house. It has to follow the principals of 
Cape Cod design in order to be considered one, and following this standard also takes advantage of work already done by 
prior architects.
* The instantiated object is the actual, fully-built house. If you do it a second time, you get a house 
with the exact same design, but it is a different physical house. One sits at 12 Mockingbird Lane, the other at 14 
Mockingbird Lane.

Let's return to the animal example we've used previously, since I can't figure out methods that make sense for a house.

We had a `LivingThing` interface, and two classes: `Animal` and `Plant`. If you look at those classes, half of what they 
did was the same. They have the same constructor, methods for setting and getting species name, and the `species` 
property. Why repeat ourselves? Let's create an abstract class that will serve as a "base" class. Remember, an abstract 
class doesn't have to implement an interface, but let's continue using that example.

```$xslt
abstract class Kingdom implements LivingThing {
 
    protected $species;
 
    public function __construct($species) {
        $this->setSpecies($species);
    }
 
    public function setSpecies($species) {
        $this->species = $species;
    }
 
    public function getSpecies() {
        return $this->species;
    }
 
}
```

Now, we can make our classes smaller.

```$xslt
class Animal extends Kingdom {
 
    protected $number_of_legs;
 
    public function setNumberOfLegs($number) {
        $this->number_of_legs = $number;
    }
 
    public function getNumberOfLegs() {
        return $this->number_of_legs;
    }
 
}
 
class Plant extends Kingdom {
 
    protected $flowering = TRUE;
 
    public function setFlowering($flowering) {
        $this->$flowering = $flowering;
    }
 
    public function getFlowering() {
        return $this->flowering;
    }

}
```

We've taken the common functionality and moved it to the base class. `Animal` and `Plant` now only contain things 
relevant to each, but will inherit all the properties and functionality from the base class.

#### Why use an abstract class? Can't we do this with any class?

You can, however, you'll miss out on three important differences.

* Abstract classes can't be instantiated, preventing their direct use. The base class may have incomplete functionality, 
since it is only intended to be part of the picture.
* Abstract classes can have abstract methods inside them, which work in a similar way to methods defined in an interface. 
This gives the abstract class the ability to define methods it does not use, but wants the child class to define. Read 
the php.net documentation page linked above for more about that.
* Abstract classes do not have to fulfill the contract of the interface.

Let's talk about that last one. Suppose I update the `LivingThing` interface to have another method. This one called 
`getKingdom()`, which will return the name of the Kingdom (Animal, Plant, etc.) Someone interacting with a species 
object, like a Cat, might want to know what Kingdom it is in.

```$xslt
interface LivingThing {
 
  public function setSpecies($species);
 
  public function getSpecies();
 
  public function getKingdom();
 
}
```

What do we do to update the `Kingdom` class? Nothing. We can ignore it. The abstract class won't break. However, we 
have now passed the buck on to the individual child classes. In this case, `Animal` and `Plant`. Since the contract has 
not been fulfilled, the `LivingThing` interface is not satisfied. The children will have to do it. This is basically 
sins of the father. The children are left with the debt to be paid. When you do this on purpose, it's ok. There might 
be things the abstract class just can't do. It may not make sense for `Kingdom` to return the Kingdom name, because it 
doesn't know anything about the child classes yet.

To fulfill that contract, the child classes must include `getKingdom()`.

```$xslt
class Animal extends Kingdom {
 
    protected $number_of_legs;
 
    public function setNumberOfLegs($number) {
        $this->number_of_legs = $number;
    }
 
    public function getNumberOfLegs() {
        return $this->number_of_legs;
    }
    
    public function getKingdom() {
        return 'Animal';
    }
 
}
 
class Plant extends Kingdom {
 
    protected $flowering = TRUE;
 
    public function setFlowering($flowering) {
        $this->$flowering = $flowering;
    }
 
    public function getFlowering() {
        return $this->flowering;
    }
    
    public function getKingdom() {
        return 'Plant';
    }

}
```

You know what does exactly this in Drupal? Forms. If you've ever made a custom form in a Drupal 8 module, you've probably 
done it by extending `FormBase`. That is an abstract class that implements `FormInterface`. In your form you are 
required to provide a `getFormId()` method that returns a string identifying the form. Check the interface. You will 
see `getFormId()` in the interface, but it is nowhere to be found in the base class. `FormBase` passes the buck on to 
you. The base class wants you to be the one to identify the form.

https://www.drupal.org/docs/8/api/form-api/introduction-to-form-api
https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Form%21FormBase.php/class/FormBase/8.5.x
https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Form%21FormInterface.php/interface/FormInterface/8.5.x