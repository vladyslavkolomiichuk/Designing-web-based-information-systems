<?php
// ================= CONFIGURATION READER =================
class Config
{
  public static $factory;
  public static $carNum;
  public static $truckNum;
  public static $busNum;

  // Load configuration from ini file
  public static function load($filename = "config.ini")
  {
    if (!file_exists($filename)) {
      throw new Exception("Configuration file not found: $filename");
    }

    $config = parse_ini_file($filename);

    self::$factory = $config['factory'] ?? 'ua';
    self::$carNum = (int)($config['carNum'] ?? 5);
    self::$truckNum = (int)($config['truckNum'] ?? 2);
    self::$busNum = (int)($config['busNum'] ?? 3);
  }
}

// ================= ABSTRACT PRODUCTS =================
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

// ================= ABSTRACT FACTORY =================
abstract class AbstractVehicleFactory
{
  abstract public function createCar(): Car;
  abstract public function createTruck(): Truck;
  abstract public function createBus(): Bus;

  // Get the proper factory based on config
  public static function getFactory()
  {
    switch (Config::$factory) {
      case 'ua':
        return new UkrainianFactory();
      case 'foreign':
        return new ForeignFactory();
      default:
        throw new Exception("Unknown factory type: " . Config::$factory);
    }
  }
}

// ================= UKRAINIAN FACTORY =================
class UkrainianFactory extends AbstractVehicleFactory
{
  public function createCar(): Car
  {
    return new UkrainianCar();
  }
  public function createTruck(): Truck
  {
    return new UkrainianTruck();
  }
  public function createBus(): Bus
  {
    return new UkrainianBus();
  }
}

// Ukrainian vehicle implementations
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

// ================= FOREIGN FACTORY =================
class ForeignFactory extends AbstractVehicleFactory
{
  public function createCar(): Car
  {
    return new ForeignCar();
  }
  public function createTruck(): Truck
  {
    return new ForeignTruck();
  }
  public function createBus(): Bus
  {
    return new ForeignBus();
  }
}

// Foreign vehicle implementations
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

// ================= MAIN PROGRAM =================
try {
  // Load configuration from file
  Config::load("config.ini");

  echo "<h3>Abstract Factory Example — Vehicle Park</h3>";
  echo "<b>Factory type:</b> " . Config::$factory . "<br>";
  echo "<b>Cars:</b> " . Config::$carNum . ", <b>Trucks:</b> " . Config::$truckNum . ", <b>Buses:</b> " . Config::$busNum . "<hr>";

  // Get the appropriate factory
  $factory = AbstractVehicleFactory::getFactory();

  echo "<h4>Generated vehicles:</h4>";

  // Create vehicles according to configuration
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
