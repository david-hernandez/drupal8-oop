# Constructor

http://php.net/manual/en/language.oop5.decon.php

A constructor is a special method you supply with a class that PHP will run when a new object is created.

```$xslt
class Animal {
 
    protected $species;
    
    public function __construct($species) {
        $this->species = $species;
    }
    
    public function getSpecies() {
        return $this->species;
    }
 
}
 
$my_animal = new Animal('Cat');
print $my_animal->getSpecies();
```

The constructor begins with a double underscore, and has the exact name of `construct`. Since it can accept parameters, 
we feed the species name directly when creating the object. This doesn't have to be used for just setting values. You 
can perform other setup tasks in here, and access other class members.

