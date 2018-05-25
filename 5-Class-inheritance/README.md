# Class Inheritance

Class inheritance is an important topic when dealing with a large application like Drupal, or a framework like Symfony, 
on which Drupal is based. The whole point of a framework is to provide utility so you don't have to do most of the work.

In any modern application or framework, this is going to be provided by classes. Many of these classes are directly 
usable with static methods, but many are purposely designed to be extended. It's important you understand how classes 
inherit members, how to access them, and how to analyze these classes to better understand the way the designers intend 
them to be used.

```$xslt
class Animal {
 
    protected $species;
    
    public function __construct() {
        $this->setSpecies('Dog');
    }
 
    public function setSpecies($species) {
        $this->species = $species;
    }
    
    public function getSpecies() {
        return $this->species;
    }
 
}
 
class Cat extends Animal {
 
    public function setSpecies($species) {
        // We'll ignore the species and set 'Cat' directly.
        $this->species = 'Cat';
    }
 
}
 
$my_animal = new Animal;
print $my_animal->getSpecies();
 
$my_cat = new Cat;
print $my_cat->getSpecies();
```

The first print statement will print 'Dog'. The second will print 'Cat'.

When a class extends another they basically get merged together. When dealing with `$my_cat`, it will contain everything 
from `Cat` and `Animal`, but since they are merged together, the members of the two classes can't have the same names. If 
they do, the ones in the child class win. This is intentional.

In the example above, when `$my_cat` is created the constructor is run. Even though it resides in the parent class it is 
still run. The two classes work together, and the constructor is treated no different than if it was part of `Cat`.

The same is true for `setSpecies`. The one added in `Cat` overrides the one in the parent class. The constructor in the 
parent class class `setSpecies`. So what happens? It runs the one in `Cat` instead of the one in `Animal`.

Let's look at a different example.

```$xslt
class Country {
 
    protected function text() {
        return "I am a country";
    }
    
    public function getText() {
        return $this->text();
    }
 
}
 
class City extends Country {
 
    protected function text() {
        return "I am a city";
    }
 
}
```

This example is simpler, but essentially the same. If a `Country` is created, `getText()` will return the country text. 
If a `City` is created it will return the city text.

Let's expand that with a new concept.

#### `parent`

```$xslt
class Country {
 
    protected function text() {
        return "I am a country";
    }
    
    public function getText() {
        return $this->text();
    }
 
}
 
class City extends Country {
 
    protected function text() {
        return parent::text() . " and " . "I am a city";
    }
 
}
 
$location = new City;
print $location->getText();
```

In a previous step of the tutorial we learned how to use `self` to access members inside the class. We can do the same 
with the parent class by using the special name `parent`. Even though `text()` has been overridden, we can still access 
the one from the parent class.

This is really handy when you want to override a parent method, but you don't really want 
to reproduce all the work it did. Perhaps the parent method returns some calculated value or an array you want to 
manipulate. Still using the parent also means that if the parent code changes, your child class will also get the 
update.
