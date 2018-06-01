# Late Static Bindings

http://php.net/manual/en/language.oop5.late-static-bindings.php

Late static binding can be a complicated thing to explain or understand, and I'm not sure this tutorial is the place to 
do it in detail. However, there is a component to this that needs demystifying. It directly relates to something you may have 
seen in Drupal and found very confusing - dependency injection.

https://www.drupal.org/docs/8/api/services-and-dependency-injection/services-and-dependency-injection-in-drupal-8

```$xslt
public function __construct(LoggerInterface $logger, SomeOtherService $other_service) {
    $this->logger = $logger;
    $this->other_service = $other_Service;
}
 
public static function create(ContainerInterface $container) {
    return new static(
        $container->get('logger.factory'),
        $container->get('foo.otherservice')
    );
}
```

You understand what constructors are now, but what the heck is that?

Let's go over the "why" first, and that might help explain the "how".

When instantiating a class you can pass arguments to it. These are things that help setup the object. They pass to 
the constructor, and the class uses them to build the new object. We've been doing that in the previous examples.

Designing a system with some complexity, you'll need to write generalized code that can call classes without knowing 
exactly what they are, or how to set them up. With the `LivingThing` examples, perhaps `Animal` has one argument, and 
`Plant` has two. This is the problem we face with Drupal's dependency injection.

In the different things we build, we want to declare dependencies on different services, but the calling code can't know 
which ones and how many.

Let's break it down with a simpler example. This time we won't use the living things, just to keep it even simpler.

```$xslt
class Foo {
 
    public $var1;
 
    public function __construct($var1) {
        $this->var1 = $var1;
    }
 
}
 
class Bar {
 
    public $var1;

    public $var2;
 
    public function __construct($var1, $var2) {
        $this->var1 = $var1;
        $this->var2 = $var2;
    }
 
}
```

We have two classes with a different number of arguments. It may not be simple to use the same code to instantiate both.
Even if we create a factory, we still need to know things about these classes to instantiate them. That is impossible 
if we are building a framework and letting developers make their own classes.

The trick here is we let the developers create their own factory when they make their class. That is what that 
`create()` method is. It's a factory that returns itself, and when it does, it can provide the correct arguments. It can 
do that because the person who wrote the class will know what they are.

```$xslt
class Foo {
 
    public $var1;
 
    public function __construct($var1) {
        $this->var1 = $var1;
    }
    
    public static function create($thing) {
        // We can take something from the generic thing and use it.
        // Let's assume it's an array of options.
        return new static($thing[0]);
    }
 
}
 
class Bar {
 
    public $var1;

    public $var2;
 
    public function __construct($var1, $var2) {
        $this->var1 = $var1;
        $this->var2 = $var2;
    }
    
    public static function create($thing) {
        return new static($thing[1], $thing[2]);
    }
 
}
```

We can now deal with these classes more generically.

```$xslt
$things = ['thing0', 'thing1', 'thing2'];
 
$foo = Foo::create($things);
$bar = Bar::create($things);
 
// $foo and $bar are both objects of the correct class.
```

In this simple example we are calling the classes directly, but getting the class name isn't too difficult for a 
framework. That is what registries and managers are for. Keep it simple for now.

The magic that makes this work is `static`. This is the late static binding. We use the method `create()` to run code 
without instantiating the class. That method returns a new object, just like the example from the factories step of 
this tutorial. But what object does it return? It returns itself. And when it does, it can specify the arguments needed 
for its own constructor. That is what `static` does. It is a substitute for something like `return new Foo($thing[0])`.

For completion sake, we can also use `self` and `parent`. Most of the time, in Drupal at least, you'll see `static` 
used so that the call is inherited by a child class. If we tried to use `self` and this code was in a base class, the
`create()` method would try to return an instance of the base class instead of the child class that is extending it. We 
don't want that.

Going back to the Drupal example, take a look at Drupal's `ClassResolver`. This class deals with some of this dependency 
injection stuff.

https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21DependencyInjection%21ClassResolver.php/class/ClassResolver/8.5.x

It has code like this:

```$xslt
$instance = $definition::create($this->container);
```

This is what calls the code at the top. It passes the service container, which is an object, and then we use that to 
retrieve whatever services we want. Those are passed to the constructor via `static`.

Hopefully, that feels a little less magical now.