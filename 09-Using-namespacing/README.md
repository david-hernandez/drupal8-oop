# More namespacing

http://php.net/manual/en/language.namespaces.importing.php

In the previous step, we went over the format for a namespace, but didn't really do anything useful 
with it. What is the point of all this? I hate to sound like a broken record, but this is how the autoloader 
finds things. You need to work _with_ the autoloader. It is your friend. It will do the work for you! Let's see it in 
action

This is Drupal's `index.php` file. We've looked at parts of it before. Let's look at the whole thing. It's short.

```$xslt
<?php
 
use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;
 
$autoloader = require_once 'autoload.php';
 
$kernel = new DrupalKernel('prod', $autoloader);
 
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
 
$kernel->terminate($request, $response);
```

The index file does not have a namespace declared, because it is not a class. This is just a plain old PHP script.

What you see first, instead, are two `use` statements.

```
use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;
```

These lines serve the same purpose as an include or require. They tell the autoloader to "import" these classes, because 
I want to "use" them. Remember when I said things are named the way they are for a reason? Notice they use the 
namespace for each of the classes. And, because they are written in the global space (at the top of the file,) they do 
not need a backslash. If the backslash was added it would still work.

With these lines in place, the references to classes can work.

```$xslt
$kernel = new DrupalKernel('prod', $autoloader);
```

This line instantiates a new object. It uses the `DrupalKernal` class to do it. How does PHP know what class the index 
file is talking about? The `use` statement. And how does it find the actual `.php` file on the computer where this 
class is located? The AUTOLOADER!!! It picks apart the namespace and uses it to know where in the directory structure 
of the application this file should be located.

Everything else is the same PHP we've already covered in this tutorial. We've got object methods, a static method being 
used, variables being passed around. Everything that seems like magic is just knowing that you follow certain naming 
conventions, and then rely on the bloody autoloader.

### More on that global namespace

I keep saying you don't need the backslash most of the time. But, when do you need it? We'll use that `DavidsPage` example.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
class DavidsPage {
    // Do controllery stuff.
    // A controller is a thing that will help make a page on our website.
}
```

This isn't the best example, but I want to stick with the same classes. Suppose I want to use `Request` in the 
`DavidsPage` class.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
class DavidsPage {
 
    public function someMethod() {
        $request = Request::createFromGlobals();
    }
 
}
```

Will that work? No. PHP doesn't know where `Request` comes from. I know what you are thinking. Add a `use` statement. 
You are correct! But, let's work our way there. In PHP you don't have to have a `use` statement to refer to another 
class. You can actually write the whole namespace out so it knows what you're referring to.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
class DavidsPage {
 
    public function someMethod() {
        $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }
 
}
```

Will that work? No. This is the global namespace problem. PHP thinks we are referring to something inside this class. 
That is why we need the backslash.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
class DavidsPage {
 
    public function someMethod() {
        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }
 
}
```

Will this work? Yes. The backslash takes us out of the class and into the global namespace to find that thing. You will 
notice, though, that this is lame. Do you want to write out the namespace every time you use a class somewhere? Of 
course not. Move it to a `use` statement instead. It serves as a shortcut telling PHP every time I refer to this thing 
I'm talking about that class from the top of the file.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
use \Symfony\Component\HttpFoundation\Request;
 
class DavidsPage {
 
    public function someMethod() {
        $request = Request::createFromGlobals();
    }
 
}
```

But, now that it is in a `use` statement at the top of the file, and therefore, now back in the global space, the 
backslash isn't needed.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
use Symfony\Component\HttpFoundation\Request;
 
class DavidsPage {
 
    public function someMethod() {
        $request = Request::createFromGlobals();
    }
 
}
```

Whew! That covers everything, right? Well, one more thing. There are some occasions where you actually will use the 
backslash. One such case is the `Drupal` class. There is a root level class in Drupal that is just called `Drupal`. 
Since its namespace is so short, and equals the vendor name, there is no reason to add a `use` statement. You will see 
it always used directly, and with a backslash.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
class DavidsPage {
 
    public function someMethod() {
        $user = \Drupal::currentUser();
    }
 
}
```

That works. You will also find places, like in configurations, where you have to specify a class to use for something. 
Generally, in those places you write the class as its namespace with a backslash, because you don't know the space where 
it will be used, and in all likelihood, it will be used inside a class. Since those sort of dynamic uses can't add a 
`use` statement on the fly, they expect the whole thing written out. Like with the `Request` example above. 
`\Symfony\Component\HttpFoundation\Request::createFromGlobals()`

### Aliasing

Last but not least, you can alias the class reference. If for some reason you want to refer to the class by a different 
name, or need to use multiple classes with the same name, you can give one an alias. Just put `as` in the `use` statement.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
use Symfony\Component\HttpFoundation\Request as DavidRocks;
 
class DavidsPage {
 
    public function someMethod() {
        $request = DavidRocks::createFromGlobals();
    }
 
}