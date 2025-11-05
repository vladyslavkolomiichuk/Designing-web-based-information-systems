<?php
// Singleton pattern for database connection
class db
{
  private static $_instance = null;
  public $db;

  // Prevent direct instantiation
  private function __construct()
  {
    echo "<h1>Connecting with database</h1>";
    $this->db = new mysqli('localhost', 'root', '');
    if ($this->db->connect_error) {
      throw new Exception("Connection error: " . $this->db->connect_error);
    }
    $this->db->query("SET NAMES 'UTF8'");
  }

  // Get the single instance
  public static function getInstance()
  {
    if (self::$_instance === null) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  // Prevent cloning and unserializing
  private function __clone() {}
  private function __wakeup() {}

  // Fetch data from "menu" table
  public function get_data()
  {
    $query = "SELECT * FROM menu";
    $result = $this->db->query($query);
    $row = [];
    while ($data = $result->fetch_assoc()) {
      $row[] = $data;
    }
    return $row;
  }
}

// ===== Demonstration =====
$obj1 = db::getInstance();
$obj2 = db::getInstance();
$obj3 = db::getInstance();

// Check if all objects refer to the same instance
if ($obj1 === $obj2 && $obj2 === $obj3) {
  echo "<h2>All variables refer to the same db instance!</h2>";
}
