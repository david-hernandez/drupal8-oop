# Operators, and All The Basics

In this first step let's cover all the basics you need to understand before you can even begin to properly 
read the code in other steps.

### Instantiation

Instantiation is a concept you really need to understand, because it affects how you use classes. You are hopefully 
familiar with at least introductory object-oriented programming.

Things like this:

```$xslt
$my_animal = new Animal;
$my_animal->setSpecies('Cat');
```

When you create a new object, you instantiate it. As far as PHP is concerned, this is a bit more complicated 
than just creating a new variable, like a plain string of text. Instantiation creates an object using the class 
as a template; setting aside memory, and performing any required setup tasks. If I do this again, with `$my_animal2`, 
I now have two objects, each existing on its own and taking up its own memory.

We need to know this, because there are ways to use classes without instantiating a new object. We'll get to 
this later.

### Extending

When a class extends another class, we create a child-parent relationship, and the child inherits most things 
from the parent.

```$xslt
class Mammal extends Animal {
 
}
 
$my_mammal = new Mammal;
$my_mammal->setSpecies('Cat');  <== Mammal inherits this from Animal.
```

### Method

A function inside a class is called a method.

```$xslt
class Animal {
 
    function setSpecies($species) {
        // Do some stuff.
    }
     
}
```

What's the difference betewen a function and a method? Nothing. Same thing. We just know that when someone 
says that word they are talking about a function inside some class.

### Property

Like method, property is just another word for the same thing. Properties are variables inside of a class.

```$xslt
class Animal {
 
    public $number_of_legs = 4;
 
    function setSpecies($species) {
        // Do some stuff.
    }
     
}
```

Ignore the `public` keyword. We'll discuss that in the "Visibility and Scope" step.

### Members

Properties, methods, constants, and anything else inside a class are called members. You may hear "class members" or "
members of that class" or similar in conversation. That's all that means.

### Operators

The list of operators includes all the things like mathematical operators and assignment operators, but there are two that 
we need to understand when dealing with classes.

#### Arrow (object operator)

The arrow (`->`) is used to access members of an instantiated object. Notice we don't use the dollar 
sign when accessing the property.

```$xslt
$my_animal = new Animal;
$my_animal->setSpecies('Cat');
$leg_count = $my_animal->number_of_legs;
```

#### Double colon (scope resolution operator)

The double colon (`::`) is used to access members of a class that has **not** been instantiated as 
an object. That's fancy, and we'll get to it later when we talk about visibility, but it is an important distinction.

```$xslt
$date = UtilityClassOfSomeSort::getTodaysDate();
```

As a general rule, if the thing to the left has a dollar sign (`$`) you'll use the arrow. If it doesn't, you'll use 
the double colon.