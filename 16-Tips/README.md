# Tips

A big part of learning how to use a framework, which really means learning how to use something someone else 
made, is understanding the intention behind certain code. Why was this done this way? Where did this come from? 
Why is this here? Either the documentation needs to be so verbose as to line-by-line explain everything, or you're going 
to have to learn to read the code.

Hopefully, many of the things you've learned in this tutorial will help you understand the actual code you see, but it 
may not fully spell out the reasons why a framework or application designer did some things a certain way. I want to add 
some tips to help you start looking at the code a little differently. Maybe it will help.

### Read the code

It sounds obvious, but a lot of people don't do that. And don't just read the code in front of your face. Look at the 
parent classes and interfaces. Especially, with something like Drupal, those classes will be **heavily** commented. 
Those comments are sometimes full of too much technical jargon, but it should at least give you clues where things come 
from, what requirements are expected, return values, etc.

### Use your IDE

If you are using a text editor and not something with IDE functionality, you need to upgrade. I use PHP Storm. I don't 
care what you use, but use something that provides project-level functionality. This is the one thing that can really 
make your life easier.

The IDE can find classes for you and display them. It can alert you to missing namepsace lines and add them for you. It 
makes searching for things a lot easier. It will automatically understand when you failed to declare something an 
interface requires. It can automatically stub out a class and include everything an interface or abstract class 
requires. It knows when the visibility of methods or properties don't match what you are trying to do. It understands 
what you have access to when working with an object. 

I do not memorize things any more. What methods can I use in that object? I dunno, let me type `$var->` and as soon as I do 
the IDE pops up a little box that shows me everything, including the arguments and return values. Learn concepts, don't 
memorize code. You aren't going to impress anyone.

### Names

Again, things are named the way they are for a reason. This doesn't just go for PHP keywords. A smart framework names its 
classes and members smartly, as well. This is why people like to follow well-defined naming conventions. What do 
you think `ClassResolverInterface` does? Or what about `getFormId()`? It shouldn't be hard. A good framework makes 
that easy. And when you name things in your own code, you should do the same. One day someone else will have to read 
your code, or you will have to read it some time in the future. Name things properly. Be clear.

### Don't just read the code, follow the clues

What is the point of interfaces? An interface that already exists is telling you that these are methods this part of 
the system is going to call. That is how a framework works. The system isn't just saying it's a good idea for your 
forms to have some unique id. It's saying you need to have `getFormId()`, because it is going to call it. It needs that 
to function. This is like your electrical device having the right plug. Not because that outlet design is the best in 
the world. You have to verify your device can work with that electrical grid. The system needs some guarantee that 
things will work a certain way. This is how we keep everything from breaking.

You see even more tell tale signs from base classes. In particular, always look for things that are **empty**. An empty 
method is almost always a method the designer of that base class intends for you to override. Why else would it be empty?

Look at something like `BlockBase` in Drupal 8. This is the base class you use to make your own custom blocks in a 
module. It has code like this:

```php
public function blockForm($form, FormStateInterface $form_state) {
    return [];
}
```

Why is that there? Why would you include an empty method that doesn't do anything? If you look further up you will find 
another method.

```php
public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    
    // Bunch of code in here.
    ...
    
    $form += $this->blockForm($form, $form_state);
    return $form;
  }
```

This method, which builds the form you see when you add a block on the block layout page, calls `blockForm()` and adds 
the result to the `$form` array before it returns. But but but, `blockForm()` is empty? When you override it in your 
child class, your array will get merged instead. This is clear intent by the designer that this is here for you!

Why do this instead of adding an abstract method definition? Because then it would be required. By including its 
own method that returns an empty array, it makes the method optional for a child class. This gets called regardless. 
Either the empty one from the base class or one from the child. Either way, the line with `$this->blockForm()` won't 
break.

You will find this kind of thing all over base classes. They are designed to be extended. The designers know what they 
are doing. LOOK FOR THE EMPTY THINGS!