# Interfaces

Interfaces are not functional code by themselves. They serve as a template of sorts for actual classes. You may have 
heard people say an interface provides a "contract" that must be fulfilled. The interface will provide definitions for 
methods and properties. It will not provide the actual contents.

```$xslt
interface LivingThing {
 
    public function setSpecies($species);
    
    public function getSpecies();
    
}
```

Notice the lack of curly braces with the methods. They are only defined in the interface. They do not contain any code. 
But, the interface dictates the name of the method and its parameters.

The members of the interface must be public. This is sort of the point. If we think about the public members of a class 
as its API, the interface helps define that API. That's why it's called an interface. (like a user interface) I keep 
saying things are named they way they are for a reason. The interface defines a baseline that others can expect when 
interacting with your class. A baseline that you are contractually obligated to fulfill, if your class implements the 
interface. (Abstract classes are an exception to this rule with, but we'll talk about that later.)

```$xslt
class Animal implements LivingThing {
 
    protected $species;
    protected $number_of_legs;
 
    public function __construct($species) {
        $this->setSpecies($species);
    }
 
    // Required by the interface.
    public function setSpecies($species) {
        $this->species = $species;
    }
 
    // Required by the interface.
    public function getSpecies() {
        return $this->species;
    }
 
    public function setNumberOfLegs($number) {
        $this->number_of_legs = $number;
    }
 
    public function getNumberOfLegs() {
        return $this->number_of_legs;
    }
 
}
```

In the code above, nothing has changed with the `Animal` class other than to specify it implements the `LivingThing` 
interface. Since we already had `setSpecies()` and `getSpecies()` there is no functional change. So let's create another 
class.

```$xslt
class Plant implements LivingThing  {
 
    protected $species;
    protected $flowering = TRUE;
 
    public function __construct($species) {
        $this->setSpecies($species);
    }
 
    // Required by the interface.
    public function setSpecies($species) {
        $this->species = $species;
    }
 
    // Required by the interface.
    public function getSpecies() {
        return $this->species;
    }
 
    public function setFlowering($flowering) {
        $this->$flowering = $flowering;
    }
    
    public function getFlowering() {
        return $this->$flowering;
    }

}
```

We now have two classes implementing the same interface.

#### So what's the point?

Since the interface defines key parts of the common API between the two classes, I can write code that will work with 
them universally.

```$xslt
// Just doing some things to show that these classes are different.
 
$animal = new Animal('Cat');
$animal->setNumberOfLegs(4);
display_living_thing($animal);
 
$plant = new Plant('Fern');
$plant->setFlowering(FALSE);
display_living_thing($plant);
 
function display_living_thing($thing) {
    print "This is a " . $thing->getSpecies();
}
```

Furthermore, I can also type hint the interface in the function definition.

```$xslt
$animal = new Animal('Cat');
$animal->setNumberOfLegs(4);
display_living_thing($animal);
 
$plant = new Plant('Fern');
$plant->setFlowering(FALSE);
display_living_thing($plant);
 
function display_living_thing(LivingThing $thing) {
    print "This is a " . $thing->getSpecies();
}
```

This ensures the function is only sent an object that implements the `LivingThing` interface. Regarless of what class it 
is, as long as it implements that interface (and fulfills the contract) I know it will have the `getSpecies()` method.

The type hinting here works because even though the two objects have specific classes (`Animal`, `Plant`) the interface 
is part of the definition of that object. It's like part of the object's lineage. Imagine a party invitation that says 
"Hernandez" on it, but not "David". I could claim it, or anyone in my family could.

This is incredibly important for application architecture. It promotes structure, code reuse, flexibility, error 
prevention, and testing. To test this function, I may need to create a fake object if the real thing is too complex to 
create for a test. (It may require a database connection, for one thing.) If I create a `TestLivingThing` class with 
fake data, I can send that object to the function as long as my test class implements the `LivingThing` interface.

If you think of an application as complex as Drupal, how can it possibly function well when there are so many classes, 
and every module and developer is able to make their own classes? Interfaces help provide the consistency needed.

For an example from Drupal, let's say you make your own block in code. You would do this by making your own block class, 
and if you've done that before you know you extend the `BlockBase` class. If you look at `BlockBase` you will see it 
implements the `BlockPluginInterface`. This interface defines many of the things that are required of blocks, like a 
`build()` method which returns the content of the block. This is how the block system can retrieve any block. The 
lineage for every block includes `BlockPluginInterface`, so there will always be a `build()` method to call.

```$xslt
class DavidsBlock extends BlockBase {
  
class BlockBase implements BlockPluginInterface {  // These have been simplified.
 
interface BlockPluginInterface {
 
    public function build();
    
}
```