<?php
// ===== Product class =====
class Patient
{
  private $age;
  private $surname;
  private $medicalCardNumber;

  // Constructor sets patient attributes
  public function __construct($surname, $age, $medicalCardNumber)
  {
    $this->surname = $surname;
    $this->age = $age;
    $this->medicalCardNumber = $medicalCardNumber;
  }

  // Display patient info
  public function show()
  {
    echo "Patient: {$this->surname}, Age: {$this->age}, Medical Card: {$this->medicalCardNumber}<br>";
  }
}

// ===== Abstract Creator (Factory Method) =====
abstract class PatientCreator
{
  // Factory Method
  abstract public function createPatient($surname, $age, $medicalCardNumber);
}

// ===== Concrete Creators =====

// Creates regular patients
class RegularPatientCreator extends PatientCreator
{
  public function createPatient($surname, $age, $medicalCardNumber)
  {
    return new Patient($surname, $age, $medicalCardNumber);
  }
}

// Creates patients with default/demo data
class DefaultPatientCreator extends PatientCreator
{
  public function createPatient($surname, $age, $medicalCardNumber)
  {
    echo "(DefaultPatientCreator) Creating patient with default attributes...<br>";
    return new Patient($surname ?: "Unknown", $age ?: 30, $medicalCardNumber ?: "MC0000");
  }
}

// ===== Demonstration =====
echo "<h3>Factory Method Pattern Demonstration</h3>";

// Use different factories
$regularFactory = new RegularPatientCreator();
$defaultFactory = new DefaultPatientCreator();

// Create patients using factory method
$p1 = $regularFactory->createPatient("Ivanenko", 25, "MC12345");
$p2 = $regularFactory->createPatient("Petrenko", 40, "MC67890");
$p3 = $defaultFactory->createPatient("", "", "");

// Show created patients
$p3->show();
$p1->show();
$p2->show();
