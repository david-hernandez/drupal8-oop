# Namespacing

https://www.php-fig.org/psr/psr-4/

http://php.net/manual/en/language.namespaces.rationale.php

https://getcomposer.org/doc/01-basic-usage.md#autoloading

Now we are getting to the real application-level stuff. How do we start using classes to build something, and not 
just any something. Something big a complicated like a CMS.

In the previous step we went over the autoloader. The autoloader helps us include classes that live in other files. That 
is conceptually fairly simple, but how does it do something more complicated. In Drupal 8 we don't just put classes in
other files. We put them in modules, and in other directories, and there are conventions we have to follow, and weird 
naming schemes. What makes all that work? What happens when two classes have the same name, for example? Let's cover 
that here.

### Namespace

A namespace is a way for a class to declare where it lives within the digital world of the application. In practice, it 
often relates in some way to the folder structure of the application, but it is not usually a one-to-one direct match 
and it does not have to be.

The major problem this solves is class name collision. When using a framework and many different libraries, they are 
bound to have some classes with the same name. Everyone probably has a `Url` class or something generic like that. A 
namespace lets the class name be the same, but give it some context so we can differentiate them. And, as with 
everything else, there are conventions to follow.

With Drupal 8, the PSR-4 standard is used. This is an important factor in making the autoloader work.

That dictates your namespace will follow this format:

```$xslt
\<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>
```

The `<NamespaceName>` is also sometimes referred to as the vendor name, which in Drupal's case is "Drupal".

Therefore:

```$xslt
\Drupal
```

The sub-namespace will be your module name, conforming to Drupal's standard for naming modules.

```$xslt
\Drupal\my_module
```

You then keep adding sub-namespace names for each directory needed to reach your class's PHP file.

```$xslt
\Drupal\my_module\Controller
```

Then, the eventual class name.

```$xslt
\Drupal\my_module\Controller\DavidsPage
```

#### `src`

This needs explaining. If you look at any Drupal module you will notice that all these classes are in a directory 
called `src`. But, you're thinking, that isn't in the namespace. This is one of those conventions. It is common 
convention fo PHP applications to put their source files in a `src` directory. While the autoloader doesn't explicitly 
require it, Drupal does.

In the previous step that talked about the autoloader, I looked at Drupal's `index.php` file and showed the line where 
it includes the autoloader. Look one line below that.

```$xslt
$autoloader = require_once 'autoload.php';
 
$kernel = new DrupalKernel('prod', $autoloader);
```

What is in `DrupalKernel`? You can find this file in `core/lib/Drupal/core/DrupalKernel.php`.

```$xslt
protected function getModuleNamespacesPsr4($module_file_names) {
    $namespaces = [];
    foreach ($module_file_names as $module => $filename) {
        $namespaces["Drupal\\$module"] = dirname($filename) . '/src';
    }
    return $namespaces;
}
```

Aha! Drupal has code that eventually gets used to tell the autoloader how to make sense of namespaces with Drupal module
names in them, but also dictates that those files should be in the `src` directory. So we don't include it in the actual 
namespace because it will be assumed.

#### backslash \

The second thing that needs explaining. If you've never dealt with it before, the backslash at the beginning of the 
namespace, or class reference, refers to the "global namespace". This tells PHP, "start at the beginning." OR, 
"start at the root." Whatever. It affects scope.

When you refer to classes in your code, you are basically at the root level. The stuff you are doing in these 
"Hello, World!" files is in the global space. However, when you go into a class, you are not in the global space any 
more. PHP now thinks the things you are referring to are located inside that class. That is a problem if that isn't 
what you want. You'll understand this better when we look at some examples.

First, let's actually use a namespace.

```$xslt
<?php
 
// Some DavidsPage.php file in a Drupal module.
 
namespace Drupal\my_module\Controller;
 
class DavidsPage {
    // Do controllery stuff.
    // A controller is a thing that will help make a page on our website.
}
```

The `namespace` line declares this classes namespace. This is based in part on the directory structure, because of 
the autoloader, and will be used by other classes to load this class. When in the actual file, it does not need the 
class name at the end because the class it defined here. Its name is right below.

As explained above, we also do not need the backslash (\) at the beginning because the `namespace` line is right at the 
top of the file. It is in the global space. It is not inside the class.

If I put the backslash there, it would be ok. It will still work. PHP won't complain. It just isn't necessary, so we don't 
do it. The problem this really solves is name collisions between the name of something inside the file and something 
we want to access outside the file, but we're always dealing with one class per file so it doesn't come up with the 
`namespace` line. That does, however, still become an issue when we are working inside the class. We'll get to that 
later.