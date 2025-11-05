<?php
// Singleton pattern implementation
class someClass
{
  // Static property that holds the single instance of the class
  protected static $_instance;

  // Private constructor to prevent direct object creation
  private function __construct()
  {
    echo "Object someClass created<br>";
  }

  // Public static method to access the single instance
  public static function getInstance()
  {
    // If the instance does not exist, create it
    if (self::$_instance === null) {
      self::$_instance = new self;
    }
    // Return the existing instance
    return self::$_instance;
  }

  // Private clone method to prevent object duplication
  private function __clone() {}

  // Private wakeup method to prevent unserialization
  private function __wakeup() {}
}

// ===== Demonstration =====

// Create two variables using the Singleton pattern
$obj1 = someClass::getInstance();
$obj2 = someClass::getInstance();

// Check if both variables point to the same instance
if ($obj1 === $obj2) {
  echo "Both variables point to the same object.<br>";
} else {
  echo "These are different objects!<br>";
}
