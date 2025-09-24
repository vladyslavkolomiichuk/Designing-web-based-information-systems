<?php
// class Coor
// {
// private $text;

// public function __construct($text) // function for setting name
// {
// $this->text = $text; //set some “text” to this “text”;
// }

// public function getName() //function for getting name
// {
// echo "<p>Name: " . $this->text . "<br>"; // printing name
// }

// // Destructor – automatically called when the object is destroyed
// public function __destruct()
// {
// echo "Object of class Coor has been destroyed!<br>";
// }
// }

// $object = new Coor("Nick"); //creating “Coor” object
// $object->getName(); //function call

// // Destroy the object
// unset($object);

// // Check if the object is deleted
// if (!isset($object)) {
// echo "Object is deleted!";
// }

class Coor
{
  private $name;
  private $login;
  private $password;

  public function __construct($name, $login, $password) // function for setting name
  {
    $this->name = $name;
    $this->login = $login;
    $this->password = $password;
  }

  public function getName() //function for getting name
  {
    echo "<p>Name: " . $this->name . "<br>"; // printing name
  }
  public function getLogin() //function for getting login
  {
    echo "<p>Login: " . $this->login . "<br>"; // printing login
  }
  public function getPassword() //function for getting password
  {
    echo "<p>Password: " . $this->password . "<br>"; // printing password
  }

  // Destructor – automatically called when the object is destroyed
  public function __destruct()
  {
    echo "Object of class Coor has been destroyed!<br>";
  }
}

$c1 = new Coor("Nick", 'nick123', '123654789'); //creating “Coor” object
$c1->getName();
$c1->getLogin();
$c1->getPassword();

$c2 = new Coor("Tolya", 'tolya123', 'adadsadd'); //creating “Coor” object
$c2->getName();
$c2->getLogin();
$c2->getPassword();

$c3 = new Coor("Gavril", 'gavril123', 'qwrwqr'); //creating “Coor” object
$c3->getName();
$c3->getLogin();
$c3->getPassword();
