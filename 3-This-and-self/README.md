# Using `$this` and `self`

When using a class in your code, you've seen how you can access properties and methods. The arrow (`->`) is used when 
you have an instance of a class, and the double colon (`::`) is used when you access static members. ("Members" just 
means the things in a class, like properties and methods. It's shorter.) 

Inside of a class you'll need to access things, too. Since you can't refer to the class or object by its name, (because 
you don't know what it is, in the case of an object,) this is what `$this` and `self` are for.

### `$this`

When there exists an instance of the class, `$this` will let you refer to members, including their current values. 
Notice it has a dollar sign. Dollar signs equals data. Whenever you are dealing with a unique instance of something, a 
plain old variable, and object, whatever, there will be a dollar sign involved.

Oh, and look, we use the arrow operator with it. Just like we do when we have an object and use its name to access 
members inside it.

```$xslt
class Animal {
 
    protected $species;
 
    public function setSpecies($species) {
        $this->species = $species;
    }
    
    public function getSpecies() {
        return $this->species;
    }
 
}
 
$my_animal = new Animal;
$my_animal->setSpecies('Cat');
 
print $my_animal->species;  <== This will cause an error. The property is protected.
print $my_animal->getSpecies();
```

Because of inheritance, `$this` will also give you access to public or protected members of any parent class.

```$xslt
class Cat extends Animal {
    
    public function setCat() {
        $this->species = 'Cat';
    }
    
}
 
$my_cat = new Cat;
$my_cat->setCat();
 
print $my_cat->getSpecies();
```

### `self`

When dealing with static members, you can't use `$this`. You don't have an instance of the class. But, you still might 
want to use other static members. `self` is designed for this purpose. It refers to the class itself, and the code 
inside it. And just like when dealing with static members, we use the double colon.

```$xslt
class DateUtility {
    
    protected static $label = "Today's date is: ";
    
    public static function getTodaysDate() {
        date_default_timezone_set('UTC');
        $date = date('Y-m-d');
 
        $text = self::$label;
        
        return $text . $date;
    }
    
}
 
print DateUtility::getTodaysDate();
```