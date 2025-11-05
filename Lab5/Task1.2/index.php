<?php
// Trait implementing Singleton pattern
trait Singleton
{
  protected static $_instance;

  // Prevent direct creation, cloning, or unserialization
  final private function __construct() {}
  final private function __clone() {}
  final private function __wakeup() {}

  // Get the single instance
  public static function getInstance()
  {
    if (static::$_instance === null) {
      static::$_instance = new static();
    }
    return static::$_instance;
  }
}

// Class using Singleton trait
class someClass
{
  use Singleton;

  public function sayHello()
  {
    echo "Hello from Singleton using Trait!<br>";
  }
}

// ===== Demonstration =====
$obj1 = someClass::getInstance();
$obj2 = someClass::getInstance();

$obj1->sayHello();

// Check if both objects are the same instance
if ($obj1 === $obj2) {
  echo "Both objects are the same.<br>";
}
