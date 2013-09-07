<?php

abstract class Mammifere
{
    private $espece;
    
    public function __construct()
    {
        $this->espece = static::getEspece();
    }
    
    public static function create()
    {
        return new static();
    }
    
    public static function getEspece()
    {
        return 'mammifere';
    }
}

class Mumain extends Mammifere 
{
    
}

class Animal extends Mammifere
{
    public static function getEspece()
    {
        return 'animal';
    }
}

class Chien extends Animal
{
    
}

var_dump(Mumain::create());
var_dump(Animal::create());
var_dump(Chien::create());


class A {
    public static function qui() {
        echo __CLASS__;
    }
    public static function test() {
        self::qui();
    }
    
    public static function foo() {
        static::qui();
    }
}

class B extends A {
    public static function qui() {
         echo __CLASS__;
    }
}

class C extends A {
    public static function qui() {
         echo __CLASS__;
    }
}

B::test();
C::foo();
