<?php

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
