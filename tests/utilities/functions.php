<?php
// We autoloaded this file on dev in composer.json

function create ($class, $attributes=[], $times = null){
    return $class::factory($times)->create($attributes);
}

function make ($class, $attributes=[], $times = null){
    return $class::factory($times)->make($attributes);
}


// we don't use create(), because we are not persisting it(saving). make() method gives u instance, raw() method gives u array of the values
