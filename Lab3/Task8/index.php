<?php
// Interface for apartment information
interface IApartmentInfo
{
  // Returns the apartment area
  public function getArea();

  // Sets the apartment area
  public function setArea($area);
}

// Interface for printing information
interface IPrintable
{
  // Outputs information about the object
  public function printInfo();
}

class Apartment implements IApartmentInfo, IPrintable
{
  // Common apartment properties
  protected $area;
  protected $rooms;

  // Constructor to initialize apartment parameters
  public function __construct($area, $rooms)
  {
    $this->area = $area;
    $this->rooms = $rooms;
    echo "Apartment created (area: {$this->area} m², rooms: {$this->rooms})<br>";
  }

  // Getters setter
  public function getArea()
  {
    return $this->area;
  }
  public function getRooms()
  {
    return $this->rooms;
  }

  // Setters
  public function setArea($area)
  {
    $this->area = $area;
  }
  public function setRooms($rooms)
  {
    $this->rooms = $rooms;
  }

  // Implementation of the printInfo() method from IPrintable
  public function printInfo()
  {
    echo "Apartment with {$this->rooms} makes up {$this->area} m²<br>";
  }

  // Destructor
  public function __destruct()
  {
    echo "Apartment object destroyed<br>";
  }
}

class OneRoomApartment extends Apartment
{
  private $city;

  // Constructor calls parent constructor and adds city information
  public function __construct($area, $city)
  {
    // Calls parent constructor with 1 room by default
    parent::__construct($area, 1);
    $this->city = $city;
    echo "One-room apartment created in {$this->city}<br>";
  }

  // Getter and setter for city
  public function getCity()
  {
    return $this->city;
  }

  public function setCity($city)
  {
    $this->city = $city;
  }

  // Overriding printInfo()
  public function printInfo()
  {
    echo "One-room apartment information:<br>";
    echo "- City: {$this->city}<br>";
    echo "- Area: {$this->area} m²<br><br>";
  }

  // Destructor
  public function __destruct()
  {
    echo "One-room apartment in {$this->city} destroyed<br>";
  }
}

// Demonstration of functionality

// Creating a general Apartment object
$apt1 = new Apartment(55, 2);
$apt1->printInfo();

echo "<hr>";

// Creating one-room apartment objects in different cities
$oneRoom1 = new OneRoomApartment(38, "Kyiv");
$oneRoom1->printInfo();

$oneRoom2 = new OneRoomApartment(42, "Lviv");
$oneRoom2->printInfo();
