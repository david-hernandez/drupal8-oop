# Building an Application

All of the previous steps should provide enough information to build a somewhat sophistic PHP application. Maybe nothing 
fancy, but something object-oriented, and with most of the components you will see in much more sophisticated 
applications.

Included in this directory will be a number of files putting all this knowledge into practice. It has an autoloader, 
interfaces, base classes, etc.

We are continuing with the animal examples, but pay attention to where things have renamed. I'm going to implement some 
common naming standards, put files in a source directory, and separate everything into different files.

The classes have been organized into different class directories. I did this so namespacing could be used and take 
better advantage fo the autoloader. It isn't a common practice to have those specific names, but it should make it 
easier to find and identify the classes. Note that the directories cannot be named things like "Interface" because that 
is a reserved word in PHP and can't be used in the namespace.

The files are commented, so most of the explanation you need is in the individual files.

The index file will print the results of three different examples. You should see results like below.

```php
It has 4 legs. It likes to eat meow mix.
It has 2 legs. It likes to eat fish.
It does not flower.
It has 2 legs. It likes to eat fish.
It does flower.
 
Cat
-----------------------------------
ID: 123, Kingdom: Animal
Description: It has 4 legs. It likes to eat meow mix.
 
Eagle
-----------------------------------
ID: 333, Kingdom: Animal
Description: It has 2 legs. It likes to eat fish.
 
Fern
-----------------------------------
ID: 1543, Kingdom: Plant
Description: It does not flower.
 
Rose
-----------------------------------
ID: 19, Kingdom: Plant
Description: It does flower.
```