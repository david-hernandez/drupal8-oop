# Drupal 8 Object-oriented Programming Fundamentals

This tutorial is intended to help those who are new to object-oriented programming (OOP) and 
struggling with the fundamentals needed for Drupal 8 development. Drupal 8 is a huge OOP shift 
compared to the procedural programming of previous versions of Drupal.

Almost everything in this tutorial is specific to PHP, not necessarily Drupal. Any PHP developer may 
find it helpful, but be aware that some of the examples and application-specific details will be based on Drupal 8.

### Prereqiusites

Many of the topics covered are introductory, and written for a beginner, but you should have some prior PHP 
experience. Also, this tutorial is not intended to take the place of a generic, introductory OOP tutorial. 
This is intended to supplement any existing one, and explain some of the details you didn't understand.

### Limitations

This tutorial will not cover all use cases and minute technical details. It aims for general usage.

For the Drupal folks, this is not a module development guide. This will help you in your module development, 
but do not expect an explanation of plugins and services and whatnot.

The PHP files provided in this tutorial should be executable, but your results may vary. And, as always, If you find 
any mistakes, please open an issue or create a pull request. Don't assume I know what I'm doing.&trade;

### Contents

* 1 - Methods, properties, the arrow (`->`) and double colon (`::`) operators
* 2 - Public, protected, private, and static keywords
* 3 - `$this` and `self`
* 4 - `__construct` methods
* 5 - How classes work together, inherit methods and properties, and `parent`
* 6 - Naming conventions for classes, methods, variables, constants, etc
* 7 - Including classes from other files and using an autoloader
* 8 - Namespacing and how it relates to the autoloader
* 9 - Using namespaces, `use` statements, and more on the global space