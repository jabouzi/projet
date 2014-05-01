<?php

class Car {
	private $make;
	private $year;
	private $engine;
	
	function __construct($make, $year, $engine) {
		$this->make = $make;
		$this->year = $year;
		// the engine object is created outside and is passed as argument to Car constructor
		// When this Car object is destroyed, the engine is still available to objects other than Car
		// If the instance of Car is garbage collected the associated instance of Engine may not be garbage collected (if it is still referenced by other objects)
		$this->engine = $engine;
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
	
	function __construct($engineCapacity, $engineSerialNumber) {
		$this->engineCapacity = $engineCapacity;
		$this->engineSerialNumber = $engineSerialNumber;
	}

	public function getEngineCapacity() {
		return $this->engineCapacity;
	}

	public function getEngineSerialNumber() {
		return $this->engineSerialNumber;
	}
}

$engine = new Engine(500, '23213ekdsdlkar');
$car = new Car('VW', 2010, $engine);
var_dump($car, $engine);
unset($car);
var_dump($car, $engine);
