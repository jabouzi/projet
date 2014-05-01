<?php

class Product {
    
    private $productName;
    private $productPrice;
    private $serialNumber;
    public $products = array();
    static $number = 0;
    
    public function  __construct($name, $price, $serial)
    {
        $this->productName = $name;
        $this->productPrice = $price;
        $this->serialNumber = $serial;
        self::$number++;
    }
    
    public function getName()
    {
        return $this->productName;
    }
    
    public function getPrice()
    {
        return $this->productPrice;
    }
    
    public function getSerial()
    {
        return $this->serialNumber;
    }
    
    function calculate_tax($tax = 1.55)
    {
        return $this->productPrice * $tax;
    }
    
    function addProduct(Product $product)
    {
        $this->products[] = $product;
    }
}

class OldTelevesion extends Product {

}

class NewTelevesion extends Product {
    
    private $yearMade;
    
    function __construct($name, $price, $serial, $year)
    {
        //$this->productName = $name;
        //$this->productPrice = $price;
        //$this->serialNumber = $serial;
        parent::__construct($name, $price, $serial);
        parent::$number++;
        $this->yearMade = $year;
    }
    
    function getYear()
    {
        return $this->yearMade;
    }

}

class Televesion extends Product {
    
    private $yearMade;
    
    function __construct($name, $price, $serial, $year)
    {
        parent::__construct($name, $price, $serial);
        parent::$number++;
        $this->yearMade = $year;
    }
    
    function getYear()
    {
        return parent::getYear();
    }
    
    public function getName()
    {
		//return parent::productName;
        return parent::getName().'_NEW';
    }
    
    public function getPrice()
    {
        return parent::getPrice();
    }
    
    public function getSerial()
    {
        return parent::getSerial();
    }
    
    public function calulate_tax()
    {
        return parent::calculate_tax();
    }

}

$prod_original = new Product('','','');
//var_dump($prod_original->getName());
//var_dump($prod_original->getPrice());
//var_dump($prod_original->getSerial());
//var_dump($prod_original->calculate_tax());
$prod_original->addProduct($prod_original);

$prod = new OldTelevesion('Sony1', 2000, '1111111111111121002193');
//var_dump($prod->getName());
//var_dump($prod->getPrice());
//var_dump($prod->getSerial());
//var_dump($prod->calculate_tax());
$prod_original->addProduct($prod);

$prod = new NewTelevesion('Sony2', 3000, '2222222222222221002193', 2010);
//var_dump($prod->getName());
//var_dump($prod->getPrice());
//var_dump($prod->getSerial());
//var_dump($prod->calculate_tax());
$prod_original->addProduct($prod);

$prod = new Televesion('Sony3', 4000, '3333333333333321002193', 2014);
//var_dump($prod->getName());
//var_dump($prod->getPrice());
//var_dump($prod->getSerial());
//var_dump($prod->calculate_tax(2.5));
$prod_original->addProduct($prod);

foreach ($prod_original->products as $prod)
{
    var_dump($prod->getName());
    var_dump($prod->getPrice());
    var_dump($prod->getSerial());
    var_dump($prod->calculate_tax()); 
    echo '<hr>';
}

var_dump(Product::$number);
