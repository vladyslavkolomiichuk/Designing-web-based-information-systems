<?php
class Apartment
{
  private $numberOfRooms;
  private $area;

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

  // Method for showing information about object
  public function show()
  {
    echo "Apartment with " . $this->area . " square meters of area and " . $this->numberOfRooms . " room(s).<br>";
  }
}

class Flatlet extends Apartment
{
  private $city;

  // Constructor for creating an object
  public function __construct($area, $city)
  {
    parent::__construct(1, $area); // Flatlet has only one room

    $this->city = $city;
    echo "Flatlet object was created.<br>";
  }

  // Destructor for clear memory after objects is deleted
  public function __destruct()
  {
    echo "Flatlet object was deleted<br>";
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
    echo "Flatlet with " . $this->getArea() . " square meters of area, in " . $this->city . ".<br>";
  }
}

// --- Demonstration ---

// Create Apartment object and show its data
$apartment = new Apartment(3, 85);
$apartment->show();

// Edit data of Apartment object and show it again
$apartment->setNumberOfRooms(4);
$apartment->setArea(95);
$apartment->show();

// Create Flatlet object and show its data
$flatlet = new Flatlet(40, "Kyiv");
$flatlet->show();

// Edit data of Flatlet object and show it again
$flatlet->setCity("Lviv");
$flatlet->setArea(45);
$flatlet->show();
