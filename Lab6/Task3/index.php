<?php

// ================= CONFIGURATION READER =================
// Reads .ini file
class Config
{
  public static $factory;
  public static $carNum;
  public static $truckNum;
  public static $busNum;

  public static function load($filename = "config.ini")
  {
    if (!file_exists($filename)) {
      throw new Exception("Config file not found: $filename");
    }
    $config = parse_ini_file($filename);

    self::$factory = $config['factory'] ?? 'ua';
    self::$carNum = (int)($config['carNum'] ?? 5);
    self::$truckNum = (int)($config['truckNum'] ?? 2);
    self::$busNum = (int)($config['busNum'] ?? 3);
  }
}

// ================= ABSTRACT PRODUCTS =================
// Product interfaces
interface Car
{
  public function getInfo();
}
interface Truck
{
  public function getInfo();
}
interface Bus
{
  public function getInfo();
}

// ================= CONCRETE PRODUCTS =================
// Product implementations (the prototypes)

// Ukrainian vehicles
class UkrainianCar implements Car
{
  public function getInfo()
  {
    return "Ukrainian Car: ZAZ Sens";
  }
}
class UkrainianTruck implements Truck
{
  public function getInfo()
  {
    return "Ukrainian Truck: KrAZ 65055";
  }
}
class UkrainianBus implements Bus
{
  public function getInfo()
  {
    return "Ukrainian Bus: Bogdan A092";
  }
}

// Foreign vehicles
class ForeignCar implements Car
{
  public function getInfo()
  {
    return "Foreign Car: Toyota Corolla";
  }
}
class ForeignTruck implements Truck
{
  public function getInfo()
  {
    return "Foreign Truck: Volvo FH16";
  }
}
class ForeignBus implements Bus
{
  public function getInfo()
  {
    return "Foreign Bus: Mercedes-Benz Tourismo";
  }
}

// ================= PROTOTYPE FACTORY =================
// This factory clones prototypes
class VehiclePrototypeFactory
{
  private $carPrototype;
  private $truckPrototype;
  private $busPrototype;

  // Receives prototypes on creation
  public function __construct(Car $carPrototype, Truck $truckPrototype, Bus $busPrototype)
  {
    $this->carPrototype = $carPrototype;
    $this->truckPrototype = $truckPrototype;
    $this->busPrototype = $busPrototype;
  }

  // Returns a clone of the car prototype
  public function createCar(): Car
  {
    return clone $this->carPrototype;
  }

  // Returns a clone of the truck prototype
  public function createTruck(): Truck
  {
    return clone $this->truckPrototype;
  }

  // Returns a clone of the bus prototype
  public function createBus(): Bus
  {
    return clone $this->busPrototype;
  }
}

// ================= MAIN PROGRAM =================
try {
  // Load config
  Config::load("config.ini");

  echo "<h3>Prototype Pattern Example — Vehicle Park</h3>";
  echo "<b>Factory type:</b> " . Config::$factory . "<br>";
  echo "<b>Cars:</b> " . Config::$carNum . ", <b>Trucks:</b> " . Config::$truckNum . ", <b>Buses:</b> " . Config::$busNum . "<hr>";

  // Create master prototypes based on config
  $carProto;
  $truckProto;
  $busProto;

  if (Config::$factory == 'ua') {
    $carProto = new UkrainianCar();
    $truckProto = new UkrainianTruck();
    $busProto = new UkrainianBus();
  } elseif (Config::$factory == 'foreign') {
    $carProto = new ForeignCar();
    $truckProto = new ForeignTruck();
    $busProto = new ForeignBus();
  } else {
    throw new Exception("Unknown factory type: " . Config::$factory);
  }

  // Init the factory with prototypes
  $factory = new VehiclePrototypeFactory($carProto, $truckProto, $busProto);

  echo "<h4>Generated vehicles (by cloning):</h4>";

  // Create vehicle park by cloning
  for ($i = 1; $i <= Config::$carNum; $i++) {
    echo $factory->createCar()->getInfo() . "<br>";
  }
  for ($i = 1; $i <= Config::$truckNum; $i++) {
    echo $factory->createTruck()->getInfo() . "<br>";
  }
  for ($i = 1; $i <= Config::$busNum; $i++) {
    echo $factory->createBus()->getInfo() . "<br>";
  }
} catch (Exception $e) {
  echo "<b>Error:</b> " . $e->getMessage();
}
