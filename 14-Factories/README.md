# Factories

A factory is a class or method that is used to create other classes. (Do I need to repeat the "things are named the way 
they are for a reason" mantra?)

They are used when you have multiple classes that serve similar purposes, but you may not want to go through the work 
of finding the right class, add a `use` statement for it, pass the right arguments, etc. This is something frameworks 
do a lot of to make your life as a developer easier.

```$xslt
$animal = new Animal('Cat');
$plant = new Plant('Fern');
```

In the `LivingThing` example I need to know that both the `Animal` and `Plant` classes exist, and deal with them 
individually. Instead, let's use a factory to deal with it. (This code could be shorter, but go with it.)

```$xslt
class Organism {
 
    public static function create($kingdom, $species) {
        switch ($kingdom) {
            case 'Animal':
                $organism = new Animal($species);
                break;
            case 'Plant':
                $organism = new Plant($species);
            default:
                // Probably throw an error here.
        }
        return $organism;
    }
 
}
```

Now we can deal with the same calling code.

```$xslt
$animal = Organism::create('Animal', 'Cat');
$plant = Organism::create('Plant', 'Fern');
```

And to further generalize it...

```$xslt
$organisms = [
    [
        'Kingdom' => 'Animal', 
        'Species' => 'Cat',
    ], 
    [
        'Kingdom' => 'Plant', 
        'Species' => 'Fern',
    ],
];
 
foreach ($organisms as $organism) {
    $array_of_objects[] = Organism::create($organism['Kingdom'], $organism['Species']);
}
```

I now have some code that I can use repeatedly, call different creatures with, feed in input from users and forms, etc.