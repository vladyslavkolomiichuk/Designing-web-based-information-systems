<?php
trait my_first_trait
{
  // A simple method that prints a greeting message
  public function traitFunction()
  {
    echo "Hello world<br>";
  }

  // A method that prints a greeting depending on the current time of day
  public function greetingByTime()
  {
    // Get the current hour in 24-hour format
    $hour = date("H");

    // Determine which greeting to display based on the hour
    if ($hour < 12) {
      echo "Good morning!<br>";
    } elseif ($hour < 18) {
      echo "Good afternoon!<br>";
    } else {
      echo "Good evening!<br>";
    }
  }
}

class HelloWorld
{
  use my_first_trait;
}

// Create an object of the class
$objTest = new HelloWorld();

// Call the methods from the trait through the class object
$objTest->traitFunction();
$objTest->greetingByTime();
