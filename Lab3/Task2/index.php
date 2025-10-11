<?php
// Abstract base class
abstract class Figure
{
  protected $centerX;
  protected $centerY;

  // Constructor to set the center coordinates
  public function __construct($centerX, $centerY)
  {
    $this->centerX = $centerX;
    $this->centerY = $centerY;
  }

  // Abstract method to calculate the area
  abstract public function getArea();

  // Method to show the coordinates of the figure's center
  public function showCenter()
  {
    echo "The center of the figure has coordinates: ({$this->centerX}, {$this->centerY})<br>";
  }
}

class Circle extends Figure
{
  private $radius;

  public function __construct($centerX, $centerY, $radius)
  {
    parent::__construct($centerX, $centerY);
    $this->radius = $radius;
  }

  // Implementation of the abstract method to calculate area of the circle
  public function getArea()
  {
    $area = pi() * pow($this->radius, 2);
    echo "Area of ​​a circle: " . round($area, 2) . "<br>";
  }
}

class Rectangle extends Figure
{
  private $width;
  private $height;

  public function __construct($centerX, $centerY, $width, $height)
  {
    parent::__construct($centerX, $centerY);
    $this->width = $width;
    $this->height = $height;
  }

  // Implementation of the abstract method to calculate area of the rectangle
  public function getArea()
  {
    $area = $this->width * $this->height;
    echo "Area of ​​a rectangle: {$area}<br>";
  }
}

// Demonstration of functionality

// Create a Circle object and display its information
$circle = new Circle(5, 8, 10);
$circle->showCenter();
$circle->getArea();

echo "<hr>";

// Create a Rectangle object and display its information
$rectangle = new Rectangle(2, 4, 6, 8);
$rectangle->showCenter();
$rectangle->getArea();
