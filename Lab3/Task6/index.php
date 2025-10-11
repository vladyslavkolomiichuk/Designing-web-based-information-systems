<?php
// Interface definition
interface Figure
{
  // Draws the figure on the screen
  public function draw();

  // Erases the figure
  public function erase();

  // Moves the figure to new coordinates
  public function move($x, $y);

  // Returns the color of the figure
  public function getColor();

  // Sets a new color for the figure
  public function setColor($color);
}

class Circle implements Figure
{
  private $color;
  private $x;
  private $y;

  // Constructor sets default color and position
  public function __construct($color = "red", $x = 0, $y = 0)
  {
    $this->color = $color;
    $this->x = $x;
    $this->y = $y;
  }

  // Draws the circle
  public function draw()
  {
    echo "Drawing a {$this->color} circle at ({$this->x}, {$this->y})<br>";
  }

  // Erases the circle
  public function erase()
  {
    echo "Erasing the circle<br>";
  }

  // Moves the circle to a new position
  public function move($x, $y)
  {
    $this->x = $x;
    $this->y = $y;
    echo "Circle moved to new position ({$this->x}, {$this->y})<br>";
  }

  // Returns the current color
  public function getColor()
  {
    return $this->color;
  }

  // Changes the color of the circle
  public function setColor($color)
  {
    $this->color = $color;
    echo "Circle color changed to {$this->color}<br>";
  }
}

class Square implements Figure
{
  private $color;
  private $x;
  private $y;

  // Constructor sets default color and position
  public function __construct($color = "blue", $x = 0, $y = 0)
  {
    $this->color = $color;
    $this->x = $x;
    $this->y = $y;
  }

  // Draws the square
  public function draw()
  {
    echo "Drawing a {$this->color} square at ({$this->x}, {$this->y})<br>";
  }

  // Erases the square
  public function erase()
  {
    echo "Erasing the square<br>";
  }

  // Moves the square to a new position
  public function move($x, $y)
  {
    $this->x = $x;
    $this->y = $y;
    echo "Square moved to new position ({$this->x}, {$this->y})<br>";
  }

  // Returns the current color
  public function getColor()
  {
    return $this->color;
  }

  // Changes the color of the square
  public function setColor($color)
  {
    $this->color = $color;
    echo "Square color changed to {$this->color}<br>";
  }
}

class Triangle implements Figure
{
  private $color;
  private $x;
  private $y;

  // Constructor sets default color and position
  public function __construct($color = "green", $x = 0, $y = 0)
  {
    $this->color = $color;
    $this->x = $x;
    $this->y = $y;
  }

  // Draws the triangle
  public function draw()
  {
    echo "Drawing a {$this->color} triangle at ({$this->x}, {$this->y})<br>";
  }

  // Erases the triangle
  public function erase()
  {
    echo "Erasing the triangle<br>";
  }

  // Moves the triangle to a new position
  public function move($x, $y)
  {
    $this->x = $x;
    $this->y = $y;
    echo "Triangle moved to new position ({$this->x}, {$this->y})<br>";
  }

  // Returns the current color
  public function getColor()
  {
    return $this->color;
  }

  // Changes the color of the triangle
  public function setColor($color)
  {
    $this->color = $color;
    echo "Triangle color changed to {$this->color}<br>";
  }
}

// Demonstration of functionality

// Creating objects of different figure types
$circle = new Circle();
$square = new Square("yellow", 5, 5);
$triangle = new Triangle("purple", 2, 3);

// Demonstrate Circle methods
$circle->draw();
$circle->move(10, 15);
$circle->setColor("orange");
$circle->erase();

echo "<hr>";

// Demonstrate Square methods
$square->draw();
$square->erase();

echo "<hr>";

// Demonstrate Triangle methods
$triangle->draw();
$triangle->erase();
