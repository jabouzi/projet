<?php

abstract class Shape
{
    # Let's assume a shape will always have a base and a height
    protected $base;
    protected $height;
    #This function can be the same for both classes 'Triangle' and 'Rectangle'
    public function getValue($base, $height)
    {
        $this->base   = $base;
        $this->height = $height;
    }
    # This might be different for each class of shape, because each Surface is calculated by a different formula ( St = b*h/2 and Sr = b*h)
    abstract public function surface();
}

class Triangle extends Shape
{
    # s = b*h/2
    public function surface()
    {
        return round((($this->base) * ($this->height) / 2), 2);
    }
}

class Rectangle extends Shape
{
    # s = b*h
    public function surface()
    {
        return round((($this->base) * ($this->height)), 2);
    }
}

$r = new Rectangle();
$r->getValue(15, 3);
echo $r->surface() . "\n"; # echo 45
$t = new Triangle();
$t->getValue(15, 3);
echo $t->surface() . "\n"; # echo 22.5
