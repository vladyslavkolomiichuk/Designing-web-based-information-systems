<?php
class Apartment
{
  private $numberOfRooms;
  private $area;

  // Static value which contains price per square meter in Apartment object
  protected static $averagePricePerSqM = 1200;

  // Constructor for creating an object
  public function __construct($numberOfRooms, $area)
  {
    $this->area = $area;
    $this->numberOfRooms = $numberOfRooms;
    echo "Apartment object was created.<br>";
  }

  // Destructor for clearing memory after objects is deleted
  public function __destruct()
  {
    echo "Apartment object was deleted<br>";
  }

  // Setter to reset price per square meter in Apartment object
  public static function setAveragePrice($price)
  {
    self::$averagePricePerSqM = $price;
  }

  // Getter to get price per square meter in Apartment object
  public static function getAveragePrice()
  {
    return self::$averagePricePerSqM;
  }

  // Setters to set a values for object
  public function setNumberOfRooms($numberOfRooms)
  {
    $this->numberOfRooms = $numberOfRooms;
  }
  public function setArea($area)
  {
    $this->area = $area;
  }

  // Getters to get a values of object
  public function getNumberOfRooms()
  {
    return $this->numberOfRooms;
  }
  public function getArea()
  {
    return $this->area;
  }

  // Method to get total price for Apartment object
  public function getPrice()
  {
    return $this->area * static::$averagePricePerSqM;
  }

  // Method for showing information about object
  public function show()
  {
    echo "Apartment with " . $this->area . " square meters of area and " . $this->numberOfRooms . " room(s). ";
    echo "Estimated price: " . $this->getPrice() . " USD.<br>";
  }
}

class Flatlet extends Apartment
{
  private $city;

  // Static value which contains price per square meter in Flatlet object
  protected static $averagePricePerSqM = 2000;

  // Constructor for creating an object
  public function __construct($area, $city)
  {
    parent::__construct(1, $area); // Flatlet has only one room

    $this->city = $city;
    echo "Flatlet object was created.<br>";
  }

  // Destructor for clearing memory after objects is deleted
  public function __destruct()
  {
    echo "Flatlet object was deleted<br>";
  }

  // Setter to reset price per square meter in Flatlet object
  public static function setAveragePrice($price)
  {
    self::$averagePricePerSqM = $price;
  }

  // Getter to get price per square meter in Flatlet object
  public static function getAveragePrice()
  {
    return self::$averagePricePerSqM;
  }

  // Setters to set a values for object
  public function setCity($city)
  {
    $this->city = $city;
  }

  // Getters to get a values of object
  public function getCity()
  {
    return $this->city;
  }

  // Method for showing information about object
  public function show()
  {
    echo "Flatlet with " . $this->getArea() . " square meters of area, in " . $this->city . ". ";
    echo "Estimated price: " . $this->getPrice() . " USD.<br>";
  }
}

// --- Demonstration ---

// Get and show price per square meters for each classes (Apartment and Flatlet)
echo "<h3>Default prices:</h3>";
echo "Apartment price per square meters: " . Apartment::getAveragePrice() . " USD<br>";
echo "Flatlet price per square meters: " . Flatlet::getAveragePrice() . " USD<br><hr>";

// Create Apartment object and show it
$ap = new Apartment(3, 80);
$ap->show();

// Create Flatlet object and show it
$fl = new Flatlet(80, "Kyiv");
$fl->show();

// Change price per square meters for each classes (Apartment and Flatlet)
echo "<hr><h3>Changing prices...</h3>";
Apartment::setAveragePrice(1000);
Flatlet::setAveragePrice(2500);

// Get and show price per square meters for each classes (Apartment and Flatlet)
echo "Apartment price per square meters: " . Apartment::getAveragePrice() . " USD<br>";
echo "Flatlet price per square meters: " . Flatlet::getAveragePrice() . " USD<br><hr>";

// Create Apartment object and show it
$ap2 = new Apartment(2, 60);
$ap2->show();

// Create Flatlet object and show it
$fl2 = new Flatlet(25, "Lviv");
$fl2->show();
