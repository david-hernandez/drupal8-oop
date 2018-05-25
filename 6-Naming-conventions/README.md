# Naming Conventions

https://www.php-fig.org/psr/psr-1/

In a lot of applications, including Drupal 8, you will notice a pattern for how things are named. Just get used to it.

Does it matter, beyond the scope of what PHP requires for naming functions and variables, what you name your class or 
its members? For the most part, no, but naming conventions help a lot with readability and predictability. This are 
import factors in communication. By simply looking at the things you are talking about, people know what they are. So 
when I mention a class just by its name, people are more likely to know I'm referring to a specific class and not a 
function or something else.

Drupal 8 follows the PSR-1 standard for naming things. These standards, many of which Drupal follows, are created by the 
PHP Framework Interoperability Group. They are like RFCs or IEEE standards. Following a common standard makes life 
easier for everyone.

### Class

Class names are written in upper camel case, or what is often referred to as studly case. Basically, capitalize the 
first letter of every word.

```$xslt
class MyClassName {
```

### Method

Method names are written in lower camel case. This is similar to studly case, but do not capitalize the first word.

```$xslt
function myCoolMethod {
```

### Property

There is no official standard for property names but you will often see them in Drupal written as either lower camel 
case or all lowercase with no separators. Camel case is gaining popularity, because it makes it easier to read a long 
name.

```$xslt
protected $someProperty;
protected $someotherproperty;
```

### Constant

Constants are all caps and use underscores as separators.

```$xslt
const DATA_FLAG = 0;
const WHY_ARE_WE_YELLING = "It's easier to see";
```

### Variables

Plain old local variables are kind of a wild west, like properties, but here are some recommendations. Keep them lower 
case, short, and if you need a separator, use an underscore. Pretty much anything that has a dollar sign will start 
lower case.

```$xslt
$this
$user
$first_name
```
It also helps to keep them short. They are more likely to be included in statements, as parameters, etc, 
and it helps to keep those lines short.

```$xslt
if ($my_clients_first_name == 'John' || $my_clients_last_name == 'Doe') {
$result = MyUtilityClass::publicMethod($wow_why_is_this_so_long, $and_another_variable, $this_will_wrap_soon)
```

These lines are hard to read.

```$xslt
if ($first_name == 'John' || $last_name == 'Doe') {
$result = MyUtilityClass::publicMethod($content, $date, $tags)
```

Much better.

### Functions

Functions, not methods, meaning not something in a class, tend to be treated like variables. Keep them lower case and 
use underscores. You'll find though that once you are dealing with a modern framework, you don't often make your own 
random functions any more. You're always dealing with classes.

### File names

Because of the autoloader, which we'll get to later, put your classes into files with the same name as the class.

```$xslt
// Animal.php
 
class Animal {
```