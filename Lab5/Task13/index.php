<?php
// ===== Trait for common methods =====
trait PatientTrait
{
  // Method to display patient info
  public function show()
  {
    echo "Patient: {$this->surname}, Age: {$this->age}, Card #: {$this->medicalCardNumber}, Clinic: {$this->clinicType}<br>";
  }
}

// ===== Abstract Product =====
abstract class AbstractPatient
{
  public $age;
  public $surname;
  public $medicalCardNumber;
  public $clinicType;

  // Include common methods
  use PatientTrait;
}

// ===== Concrete Products =====
class StatePatient extends AbstractPatient
{
  public function __construct($surname, $age, $card)
  {
    $this->surname = $surname;
    $this->age = $age;
    $this->medicalCardNumber = $card;
    $this->clinicType = "State Clinic";
  }
}

class PrivatePatient extends AbstractPatient
{
  public function __construct($surname, $age, $card)
  {
    $this->surname = $surname;
    $this->age = $age;
    $this->medicalCardNumber = $card;
    $this->clinicType = "Private Clinic";
  }
}

// ===== Abstract Factory =====
abstract class PatientFactory
{
  // Factory method to create a patient
  abstract public function createPatient($surname, $age, $card);

  // Static method to get appropriate factory
  public static function getFactory($type)
  {
    return match ($type) {
      'state' => new StateClinicFactory(),
      'private' => new PrivateClinicFactory(),
      default => throw new Exception("Unknown factory type")
    };
  }
}

// ===== Concrete Factories =====
class StateClinicFactory extends PatientFactory
{
  public function createPatient($surname, $age, $card)
  {
    return new StatePatient($surname, $age, $card);
  }
}

class PrivateClinicFactory extends PatientFactory
{
  public function createPatient($surname, $age, $card)
  {
    return new PrivatePatient($surname, $age, $card);
  }
}

// ===== Demonstration =====
echo "<h3>Abstract Factory — Patient Management</h3>";

// Get factories
$stateFactory = PatientFactory::getFactory('state');
$privateFactory = PatientFactory::getFactory('private');

// Create patients
$patient1 = $stateFactory->createPatient("Ivanenko", 25, "MC001");
$patient2 = $privateFactory->createPatient("Petrenko", 40, "MC002");

// Show patient info
$patient1->show();
$patient2->show();
