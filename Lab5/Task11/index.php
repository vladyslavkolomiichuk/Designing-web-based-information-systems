<?php
// ===== Global configuration =====
class Config
{
  // Determines which factory to use (1 or 2)
  public static $factory = 1;
}

// ===== Product interface =====
interface Product
{
  public function getName();
}

// ===== Abstract Factory =====
abstract class AbstractFactory
{
  // Choose which concrete factory to use
  public static function getFactory()
  {
    switch (Config::$factory) {
      case 1:
        return new FirstFactory();
      case 2:
        return new SecondFactory();
      default:
        throw new Exception("Bad config: factory not found");
    }
  }

  // Abstract method to get a product
  abstract public function getProduct();
}

// ===== First Factory and Product =====
class FirstFactory extends AbstractFactory
{
  public function getProduct()
  {
    return new FirstProduct();
  }
}

class FirstProduct implements Product
{
  public function getName()
  {
    return "The product from the first factory";
  }
}

// ===== Second Factory and Product =====
class SecondFactory extends AbstractFactory
{
  public function getProduct()
  {
    return new SecondProduct();
  }
}

class SecondProduct implements Product
{
  public function getName()
  {
    return "The product from the second factory";
  }
}

// ===== Demonstration =====
echo "<h3>Abstract Factory Pattern Demonstration</h3>";

// Use the first factory
$firstProduct = AbstractFactory::getFactory()->getProduct();
echo $firstProduct->getName() . "<br>";

// Switch to the second factory
Config::$factory = 2;
$secondProduct = AbstractFactory::getFactory()->getProduct();
echo $secondProduct->getName() . "<br>";
