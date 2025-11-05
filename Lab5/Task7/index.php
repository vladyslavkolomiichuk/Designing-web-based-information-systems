<?php
// ===== Base class =====
class Vehicle
{
  protected $country;
  protected $brand;
  protected $year;

  public function __construct($country, $brand, $year)
  {
    $this->country = $country;
    $this->brand = $brand;
    $this->year = $year;
  }

  // Show basic vehicle info
  public function showInfo()
  {
    echo "Country: {$this->country}, Brand: {$this->brand}, Year: {$this->year}<br>";
  }
}

// ===== Derived classes =====

// Car class with additional attributes
class Car extends Vehicle
{
  private $engine;
  private $power;
  private $color;

  public function __construct($country, $brand, $year, $engine, $power, $color)
  {
    parent::__construct($country, $brand, $year);
    $this->engine = $engine;
    $this->power = $power;
    $this->color = $color;
  }

  public function showInfo()
  {
    parent::showInfo();
    echo "Engine: {$this->engine}, Power: {$this->power} HP, Color: {$this->color}<br><br>";
  }
}

// Bike class
class Bike extends Vehicle
{
  private $weight;
  private $type;
  private $wheelDiameter;

  public function __construct($country, $brand, $year, $weight, $type, $wheelDiameter)
  {
    parent::__construct($country, $brand, $year);
    $this->weight = $weight;
    $this->type = $type;
    $this->wheelDiameter = $wheelDiameter;
  }

  public function showInfo()
  {
    parent::showInfo();
    echo "Weight: {$this->weight} kg, Type: {$this->type}, Wheel diameter: {$this->wheelDiameter} inches<br><br>";
  }
}

// Motorcycle class
class Motorcycle extends Vehicle
{
  private $engine;
  private $color;
  private $type;

  public function __construct($country, $brand, $year, $engine, $color, $type)
  {
    parent::__construct($country, $brand, $year);
    $this->engine = $engine;
    $this->color = $color;
    $this->type = $type;
  }

  public function showInfo()
  {
    parent::showInfo();
    echo "Engine: {$this->engine}, Color: {$this->color}, Type: {$this->type}<br><br>";
  }
}

// ===== Factory class =====
class VehicleFactory
{
  // Create a vehicle based on type
  public static function create($type, $params)
  {
    switch (strtolower($type)) {
      case 'car':
        return new Car(
          $params['country'],
          $params['brand'],
          $params['year'],
          $params['engine'],
          $params['power'],
          $params['color']
        );
      case 'bike':
        return new Bike(
          $params['country'],
          $params['brand'],
          $params['year'],
          $params['weight'],
          $params['type'],
          $params['wheelDiameter']
        );
      case 'motorcycle':
        return new Motorcycle(
          $params['country'],
          $params['brand'],
          $params['year'],
          $params['engine'],
          $params['color'],
          $params['type']
        );
      default:
        echo "<b>Error:</b> VehicleFactory cannot create a vehicle of type '{$type}'.<br><br>";
        return null;
    }
  }
}

// ===== Demonstration =====
echo "<h3>Factory Pattern Demonstration</h3>";

// Create vehicles using the factory
$car = VehicleFactory::create('car', [
  'country' => 'Germany',
  'brand' => 'BMW',
  'year' => 2020,
  'engine' => 'V6',
  'power' => 320,
  'color' => 'Black'
]);

$bike = VehicleFactory::create('bike', [
  'country' => 'Italy',
  'brand' => 'Bianchi',
  'year' => 2022,
  'weight' => 12,
  'type' => 'Road',
  'wheelDiameter' => 28
]);

$motorcycle = VehicleFactory::create('motorcycle', [
  'country' => 'Japan',
  'brand' => 'Yamaha',
  'year' => 2021,
  'engine' => 'Inline-4',
  'color' => 'Blue',
  'type' => 'Sport'
]);

$unknown = VehicleFactory::create('plane', [
  'country' => 'USA',
  'brand' => 'Boeing',
  'year' => 2023
]);

// Display vehicle info if created
if ($car) $car->showInfo();
if ($bike) $bike->showInfo();
if ($motorcycle) $motorcycle->showInfo();
