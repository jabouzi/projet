<?php

class Car {
	private $make;
	private $year;
	private $engine;
	
	function __construct($make, $year, $engine, $engineCapacity, $engineSerialNumber) {
		$this->make = $make;
		$this->year = $year;
		// the engine object is created outside and is passed as argument to Car constructor
		// When this Car object is destroyed, the engine is still available to objects other than Car
		// If the instance of Car is garbage collected the associated instance of Engine may not be garbage collected (if it is still referenced by other objects)
		$this->engine = new Engine($engineCapacity, $engineSerialNumber, $this);
	}
    
    function  __destruct() {
        unset($this->engine);
    }

	public function getMake() {
		return $this->make;
	}

	public function getYear() {
		return $this->year;
	}

	public function getEngine() {
		return $this->engine;
	}
}

class Engine {
	private $engineCapacity;
	private $engineSerialNumber;
    public $car;
	
	function __construct($engineCapacity, $engineSerialNumber, $car) {
		$this->engineCapacity = $engineCapacity;
		$this->engineSerialNumber = $engineSerialNumber;
        $this->car = $car;
	}

	public function getEngineCapacity() {
		return $this->engineCapacity;
	}

	public function getEngineSerialNumber() {
		return $this->engineSerialNumber;
	}
}

$car = new Car('VW', 2010, $engine, 500, '23213ekdsdlkar');
$engine = &$car->getEngine();
var_dump($car, $engine);
unset($car);
var_dump($car, $engine);
