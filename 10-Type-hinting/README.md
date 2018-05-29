# Type Hinting (also called type declaration)

Type hinting is when you specify a variable's type in a method or function definition. (The `function foo($var) {` is the 
definition.) You're basically defining the 
requirements. PHP is a loosely (weak) typed language. That means you don't have to explicitly declare variable types. 
You can just dump text or integers or whatever into a variable. And you can do the same when defining parameters for 
your methods and functions. That introduces some problems.

```$xslt
function display_creature($creature) {
    $species = $creature->getSpecies();
    print "This is a " . $species;
}
```

If you've been following along with the examples from previous steps in the tutorial, you'd assume `$creature` to be an 
object of class `Animal`. But what happens when this function is sent something else? A string, or an integer, or some 
other type of object that doesn't have a `getSpecies()` method? It is going to err. Who's fault is that? Is it the 
fault of the code calling this function? Is it the fault of the creator of this function?

```$xslt
$some_string = "Hello, World!";
$count = 1;
 
do_work($some_string, $count);
 
function do_work($should_be_an_array, $count) {
    if ($count > 1) {
        // Do some array work.
    else {
        // Do some work that doesn't need to use the $should_be_an_array variable.
        // Maybe just print some predefined text.
    }
}
```

With the code above, you'll get an error as soon as the count is over one. (And it will be a fatal error.) Well, maybe 
based on the way your application works that doesn't happen often. You may not notice while developing and doing 
some manual testing.

To prevent problems before they occur, and to better define a structure for our application, type hinting is an asset.

```$xslt
function display_creature(Animal $creature) {
    $species = $creature->getSpecies();
    print "This is a " . $species;
}
```

By simply adding the class name before the parameter, we explicitly declare what is required to use this function. Now, 
when someone else tries to use your function, they can't even try unless they pass the correct type for `$creature`.

#### Can this be used for things besides classes?

Yes. You can declare most things. However, integer, string, and boolean type hinting requires PHP 7. In PHP 5 and later 
you can do this for arrays and classes. That is why you don't see it used much beyond arrays and classes. Your application 
will have to require PHP 7. At the time of this writing most applications and frameworks are remaining backwards compatible 
with PHP 5 so declaring types for things like integers is not yet a reality.

#### Why wasn't this explained earlier? It seems kind of fundamental.

It is, but it's not important for the previous steps of the tutorial, and I didn't feel like including it in all the 
examples. It is, however, important to cover before we discuss interfaces.