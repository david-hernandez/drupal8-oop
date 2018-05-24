# Visibility and Scope

http://php.net/manual/en/language.oop5.visibility.php
http://php.net/manual/en/language.variables.scope.php

Visibility and scope are import in dictating how a class and the things inside them (methods and properties) 
are used.

### Public

When something is declared public, it is accessible everywhere. From an instantiated object, from a child class, 
and within the class itself. When a method is not specified as public, protected, or private, it defaults to public.

```$xslt
class Animal {
 
    public $number_of_legs = 4;
 
    public function setSpecies($species) {
        // Do some stuff.
    }
 
}
 
$my_animal = new Animal;
$my_animal->setSpecies('Cat');
$leg_count = $my_animal->number_of_legs;
```

Both the property and the method above are public, so I can access them from the object (`$my_animal`), inside the 
`Animal` class, and inside any classes that extends `Animal`.

### Protected

When something is declared protected, it is not accessible from an instantiated object, but it is accessible elsewhere.

```$xslt
class Animal {
 
    protected $number_of_legs = 4;
 
    protected function setSpecies($species) {
        // Do some stuff.
    }
 
}
 
class Mammal extends Animal {
    // I can access $number_of_legs and setSpecies() in here.
}
 
$my_animal = new Animal;
$leg_count = $my_animal->number_of_legs;  <== NOPE, and same goes for setSpecies().
 
$my_mammal = new Mammal;
$leg_count = $my_mammal->number_of_legs;  <== NOPE, too.

```

Why do we do this? It seems rather unfair to the object. Well, this is part of software design. When you work 
with a class, the things you have access to are like the API of that class. Think of each as their own  little 
application. The designer may have some things that are internal and not intended to be used directly. These things 
tend to be utility in nature and help the class operate, but wouldn't be useful to anyone using the object. 

Making things protected can prevent future errors by preventing people from using them in ways not intended. Especially, 
when those things might change. For example, what if I want to rename `$number_of_legs`? That would be an API break, 
if I'm letting people use it.

You will, of course, note that while the object does not have access to protected things, a class that extends it does. 
This is like the company you purchased your dishwasher from refusing to send you the maintenance manual and parts 
catalog for your dishwasher, but they will send it to a licensed repair company they work with.

### Private

When something is declared private, it's private. No touching.

```$xslt
class Animal {
 
    private $number_of_legs = 4;
 
    private function setSpecies($species) {
        // Do some stuff.
    }
    
    // These things can accessed within the Animal class.
 
}
 
class Mammal extends Animal {
    // NOPE now.
}
 
$my_animal = new Animal;
$leg_count = $my_animal->number_of_legs;  <== NOPE still.
 
$my_mammal = new Mammal;
$leg_count = $my_mammal->number_of_legs;  <== NOPE, too.
```

These things are private to the `Animal` class. Whoever made it does not want anyone touching them. They are internal 
only. If, however, they have some additional use, a public method may be provided to retrieve them.

```$xslt
public function getAnimalLegs() {
    return $this->number_of_legs;
}
...
 
$leg_count = $my_animal->getAnimalLegs();
```

This gives the designer of the class greater control over how it is used, and makes future maintenance easier. If the 
way the number of legs is calculated changes, or I change the purpose of the property, I only have to worry about 
returning the correct value from `getAnimalLegs()`.

### Static

Static access is an important thing to understand. When something is declared static, it is accessible without an instantiated object. This is when you see the double 
colon (`::`) used. It is used with other keywords.

```$xslt
class Animal {
 
    public static $number_of_legs = 4;
 
    public static function setSpecies($species) {
        // Do some stuff.
    }
 
}
 
$my_animal = new Animal;  <== You don't need to do this.
 
Animal::setSpecies('Cat');  <== This could work, but it's dumb. Let's talk about this below.
 
$leg_count = Animal::$number_of_legs;  <== Less dumb, but still kinda dumb. Notice the dollar sign.
```

Let's break this down a little.

```$xslt
public static $number_of_legs = 4;
 
Animal::$number_of_legs;
```

Declaring the property public means we can access it from an object and everywhere else. Declaring it static 
means we can also access it without an object. Since it has a default value set (`4`) we would be able to retrieve 
that value directly from the class.

The format for doing this is to write the class name, `Animal`, followed by a double colon, then the method or property we 
want to access. Notice that in the case of a property, we use a dollar sign (`$`) to identify the property. We did not do 
this with the arrow operator (`->`). Just remember that there will always be at least one dollar sign when dealing 
with properties. Either there is an object which will have one, or the property will. There will not be two.

```$xslt
public static function setSpecies($species) {
    // Do some stuff.
}
...
 
Animal::setSpecies('Cat');
```

The same is true for this method. We can access the method directly, without an object, and tell it to do work. In this 
case, we can also feed it a value, `Cat`, and assume it will do something with it.

#### So why is this a bad example?

Static things are not meant to change or have a real state to them. That is what the word 'static' means. Remember, 
things tend to get named the way they do for a reason. So this kind of functionality doesn't make a lot of sense for 
something like an animal class. 

Animals are data-driven. They represent cats, dogs, birds, etc. They have different names, numbers of legs, sizes, and 
other properties specific to their species. Functionality, and data, that isn't specific to a species probably doesn't 
make sense. And, a method named `setSpecies`, without a unique object to hold that data, certainly doesn't seem to make 
much sense. What are we setting, if we don't have an object to hold it?

These are the things an architect thinks about when designing a framework or application. How will all of this be used?

If we look at a different example, like PHP's built-in `DateTime` class, things make a bit more sense.

http://php.net/manual/en/class.datetime.php

See how it has static methods, like `createFromFormat`?

```$xslt
$my_date = DateTime::createFromFormat('Y-m-d', $some_timestamp);
```

We aren't asking the `DateTime` class to store anything or create a new object. We ask it to do work, and return the 
result.

**Before all the advanced students say anything about this not being one hundred percent true, and the ways you can 
make static methods and properties hold data and do fancy things, I know. But we're not aiming for a Masters 
degree in PHP here. Let's walk before we run.**