# Common errors

This is a list of some common errors you may encounter when dealing with classes. Sometimes the error is less obvious then 
it first seems. Problems with inheritance, like failing to implement a required method, will often result in an 
error with the class being instantiated. You have to look beyond that class to see why.

First things first, read the error. It will tell you what is wrong, even if you have to decode a little bit. So many 
people don't do this and immediately jump to looking at their code.

```php
Fatal error: Class contains 1 abstract method and must therefore be declared abstract or implement the remaining methods
```
The "class must therefore be declare abstract" error happens all the time. You forgot to include a method that was 
required by the interface. If you are using a base class, don't just check there. Check the interfaces the base class 
implements. It may be passing on a requirement to your class. This is where an IDE really helps. It will tell you 
immediately. In PHP Storm I'm constantly looking for those spots where it underlines code to indicate an error.

```php
Fatal error: Access type for interface method must be omitted in 
```

Interface methods must be public. Check to see if you mistakenly made one protected or private.

```php
Fatal error: Interface function cannot contain body
```

You can't put functional code in an interface, only the definition. If you didn't do that, check to see if you added 
curly braces. It should only look like this - `public function getDescription();`

```php
Fatal error: Uncaught Error: Cannot instantiate abstract class
```

That should be pretty obvious. You can't instantiate an abstract class. Your code is pointing to the wrong thing. There 
should be a class somewhere you should use that isn't an abstract class.

```php
Fatal error: Uncaught Error: Call to undefined method
```

An "undefined" error should be obvious. You are referencing something that doesn't exist. If you know the member exists 
than this most certainly indicates a typo.

```php
Fatal error: Uncaught Error: Class 'Organism' not found in
```

The class cannot be found. You probably forgot to add a use statement at the top of the file.

```php
Fatal error: Uncaught Error: Class 'Classes\Services\Organism' not found in
```

The two errors above may look the same but pay attention to the class. The first one lists the class name and the 
second the class name with the full namespace. With the second, either there is a mistake in the use statement, the 
autoloader, or something related to it. For example, if your framework expects classes in a certain folder but you 
didn't put it in the right place.