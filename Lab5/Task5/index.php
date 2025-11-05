<?php

// Product class which defines an automobile
class Automobile
{
  private $vehicleMake;
  private $vehicleModel;

  // Constructor sets the make and model
  public function __construct($make, $model)
  {
    $this->vehicleMake = $make;
    $this->vehicleModel = $model;
  }

  // Return full name of the vehicle
  public function getMakeAndModel()
  {
    return $this->vehicleMake . ' ' . $this->vehicleModel;
  }
}

// Factory class which creates Automobile objects
class AutomobileFactory
{
  public static function create($make, $model)
  {
    return new Automobile($make, $model); // return new object
  }
}

// ===== Demonstration =====
$veyron = AutomobileFactory::create('Bugatti', 'Veyron');
$mustang = AutomobileFactory::create('Ford', 'Mustang');
$camry = AutomobileFactory::create('Toyota', 'Camry');

// Output results
echo "<h3>Factory Pattern Demonstration:</h3>";
echo "Created automobile 1: " . $veyron->getMakeAndModel() . "<br>";
echo "Created automobile 2: " . $mustang->getMakeAndModel() . "<br>";
echo "Created automobile 3: " . $camry->getMakeAndModel() . "<br>";
