<?php
// Abstract parent class
abstract class PatientBase
{
  protected $surname;
  protected $age;
  protected $medicalCardNumber;
  protected $diagnosis;

  public function __construct($surname, $age, $medicalCardNumber, $diagnosis)
  {
    $this->surname = $surname;
    $this->age = $age;
    $this->medicalCardNumber = $medicalCardNumber;
    $this->diagnosis = $diagnosis;
  }

  // Abstract method for displaying patient information
  abstract public function showInfo();

  // Method to understand if patient is adult ot not
  public function isAdult()
  {
    return $this->age >= 18;
  }
}

// Class for adult patients
class Patient extends PatientBase
{
  private $creditCard;

  public function __construct($surname, $age, $medicalCardNumber, $diagnosis, $creditCard)
  {
    parent::__construct($surname, $age, $medicalCardNumber, $diagnosis);
    $this->creditCard = $creditCard;
  }

  // Implementation of abstract method
  public function showInfo()
  {
    echo "Patient: {$this->surname}, {$this->age} years old<br>";
    echo "Medical card number: {$this->medicalCardNumber}<br>";
    echo "Diagnosis: {$this->diagnosis}<br>";
    echo "Adult: " . ($this->isAdult() ? "Yes" : "No") . "<br>";
    echo "Credit card: {$this->creditCard}<br><br>";
  }
}

// Class for child patients
class ChildPatient extends PatientBase
{
  private $parentName;

  public function __construct($surname, $age, $medicalCardNumber, $diagnosis, $parentName)
  {
    parent::__construct($surname, $age, $medicalCardNumber, $diagnosis);
    $this->parentName = $parentName;
  }

  // Implementation of abstract method
  public function showInfo()
  {
    echo "Child patient: {$this->surname}, {$this->age} years old<br>";
    echo "Medical card number: {$this->medicalCardNumber}<br>";
    echo "Diagnosis: {$this->diagnosis}<br>";
    echo "Parent: {$this->parentName}<br>";
    echo "Adult: " . ($this->isAdult() ? "Yes" : "No") . "<br><br>";
  }
}

// Demonstration of functionality

$adult = new Patient("Ivanenko", 35, "A12345", "Flu", "UA12335952350");
$child = new ChildPatient("Petrenko", 10, "B67890", "Cough", "Olga Petrenko");

$adult->showInfo();
$child->showInfo();
