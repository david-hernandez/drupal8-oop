# Including Classes from Other Files

http://php.net/manual/en/language.oop5.autoload.php

We've talked a lot about classes so far, but all the examples we've dealt with have dumped all the classes into one 
file. When they are in one file it's real easy for PHP to know what we're talking about, but it's real tedious. You 
can't build anything more than a simple script if you have to dump it all in one file. Instead, you're going to want
to put your code in different files.

You might have come here because you want to learn about autoloaders and how they work with something like Drupal and 
Composer. Great. However, for you to understand its importance, we need to start from the beginning.

### Including the old fashioned way

Suppose I take the `Animal` class and put it in another file. I will call it `Animal.php`

```$xslt
// Goes in Animal.php
 
class Animal {
 
  protected $species;
  protected $number_of_legs;
 
  public function __construct($species) {
    $this->setSpecies($species);
  }
 
  public function setSpecies($species) {
    $this->species = $species;
  }
 
  public function getSpecies() {
    return $this->species;
  }
 
  public function setNumberOfLegs($number) {
    $this->number_of_legs = $number;
  }
 
  public function getNumberOfLegs() {
    return $this->number_of_legs;
  }
 
}
```

Then, I create the script I am going to run. Maybe it is `index.php` or whatever.

```$xslt
// My other PHP file.
 
$my_animal = new Animal('Cat');
$my_animal->setNumberOfLegs(4);
 
print $my_animal->getSpecies()
print $my_animal->getNumberOfLegs();
```

This won't work. PHP doesn't know what we're talking about. It doesn't know where `Animal` is. So we have to include it 
somehow, and by any means necessary. Seriously. For this example, I don't care how you do it. I'll do it with 
`require_once`.

```$xslt
require_once('Animal.php');
 
$my_animal = new Animal('Cat');
$my_animal->setNumberOfLegs(4);
 
print $my_animal->getSpecies()
print $my_animal->getNumberOfLegs();
```

This sucks.

You can't architect a remotely sophisticated or flexible system this way. You might want directories. What if something 
moves? How do you deal with a framework or being a framework designer, and not always knowing where people might put 
things?

We need it to "just work".

### Autoloader

PHP has some built-in tools to automatically recognize that you are trying to include a class and deal with it. There 
are also systems that come with these tools, but the concept is the same. It is an autoloader. Meaning, literally, it 
automatically loads that thing for you. If you are using Drupal 8, Symfony, or pretty much anything that works with 
Composer (the PHP package manager,) you are using an autoloader. You may not realize it, but you are. 

```$xslt
// This is the autoload functionality.
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
 
$my_animal = new Animal('Cat');
$my_animal->setNumberOfLegs(4);
 
print $my_animal->getSpecies()
print $my_animal->getNumberOfLegs();
```

Let's look at just that part.

```$xslt
spl_autoload_register()
```

This is a built-in PHP function. We use it to register a function we create as the thing that will do the autoloading. 
In this case our autoloader is really simple and we can pass the entire function as the parameter, instead of making a
separate function, giving it a name, and then passing that to `spl_autoload_register()`.

```$xslt
function ($class_name) {
    include $class_name . '.php';
}
```

This is the function. Because it is passed directly, it didn't need to have a name, so that is why you don't see it 
here. The function will get fed the name of the class PHP is trying to find (`$class_name`). Then, it automatically 
creates an include line, assuming the class to be in a file with the same name. In our example, it will look for 
`Animal.php`.

Every class loader is just a more complicated version of this. The complicated ones let you do things like put 
classes all over the place. For this one, the file would still need to be in the same directory. This is also why most 
naming conventions dictate that you create one class per file, and call the file the same thing. It is for the 
autoloader. We need to stick with some naming convention in order to find these things automatically.

### A more complicated example

Drupal 8 is a far more complicated application than just "stick all your stuff in a directory." It uses Composer to 
build the application. (If you haven't seen my Composer tutorial, check my Github account.) One of the benefits of 
Composer is it comes with an autoloader, so Drupal 8 doesn't have to reinvent the wheel.

If you look at Drupal 8's `index.php` files you will see this:

```$xslt
$autoloader = require_once 'autoload.php';
```

What's in that file?

```$xslt
return require __DIR__ . '/vendor/autoload.php';
```

The `vendor` directory is where Composer puts everything. Well, what's in that file?

```$xslt
<?php
 
// autoload.php @generated by Composer
 
require_once __DIR__ . '/composer/autoload_real.php';
 
return ComposerAutoloaderInitDrupal8::getLoader();
```

So it returns the result of a static method that lives inside a class. Hmm. What does that do?

```$xslt
<?php
 
// autoload_real.php @generated by Composer
 
class ComposerAutoloaderInitDrupal8 {
...
 
public static function getLoader() {
    if (null !== self::$loader) {
        return self::$loader;
    }
 
    spl_autoload_register(array('ComposerAutoloaderInitDrupal8', 'loadClassLoader'), true, true);
...
```

Oh, look. It does a bunch of fancy, complicated stuff until it uses `spl_autoload_register()` like we did on our own. 
Magic! This is what enables us to put classes all over the place in Drupal 8, and use them in other classes, but 
somehow it all "just works". Well, it never just works. There is always code somewhere doing it. You may just not know 
where that code is.