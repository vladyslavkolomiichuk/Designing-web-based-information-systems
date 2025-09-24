<?php
class Patient
{
  public $age;
  public $surname;
  public $medicalCardNumber;

  private $diagnosis;

  // Setters for entering data into fields
  public function setAge($age)
  {
    $this->age = $age;
  }
  public function setSurname($surname)
  {
    $this->surname = $surname;
  }
  public function setMedicalCardNumber($medicalCardNumber)
  {
    $this->medicalCardNumber = $medicalCardNumber;
  }
  public function setDiagnosis($diagnosis)
  {
    $this->diagnosis = $diagnosis;
  }

  // Getters for accessing fields
  public function getAge()
  {
    return $this->age;
  }
  public function getSurname()
  {
    return $this->surname;
  }
  public function getMedicalCardNumber()
  {
    return $this->medicalCardNumber;
  }
  public function getDiagnosis()
  {
    return $this->diagnosis;
  }

  // Method show to show information about object
  public function show()
  {
    $this->privateMessage(); // Access to private method inside a class
    echo "Patient's surname: " . $this->surname . ". Age: " . $this->age . ". Medical card number: " . $this->medicalCardNumber . ". Diagnosis: " . $this->diagnosis . "<br>";
  }

  // Method searchBySurname to find object with searching surname
  public function searchBySurname($value)
  {
    if (strcasecmp($this->surname, $value) == 0) { // Show object's information if found it
      echo "Patient found: ";
      $this->show();

      return true;
    } else { // If not, show a default message
      echo "Patient with surname " . $value . " not found<br>";
      return false;
    }
  }

  // Private method privateMessage to log object's creation
  private function privateMessage()
  {
    echo "(Private message: patient data displayed successfully)<br>";
  }

  // Static method showObjects to show an array of objects
  public static function showObjects($patients)
  {
    foreach ($patients as $p) {
      $p->show();
    }
  }
}

// === Demonstration ===

// Create 3 patients
$p1 = new Patient();
$p1->setSurname("Ivanenko");
$p1->setAge(25);
$p1->setMedicalCardNumber("MC12345");
$p1->setDiagnosis("Flu");

$p2 = new Patient();
$p2->setSurname("Petrenko");
$p2->setAge(40);
$p2->setMedicalCardNumber("MC67890");
$p2->setDiagnosis("Hypertension");

$p3 = new Patient();
$p3->setSurname("Sydorenko");
$p3->setAge(32);
$p3->setMedicalCardNumber("MC54321");
$p3->setDiagnosis("Diabetes");

// Display data
$p1->show();
$p2->show();
$p3->show();

// Search for a patient
echo "<br>Searching for 'Petrenko':<br>";
$p1->searchBySurname("Petrenko"); // Not found
$p2->searchBySurname("Petrenko"); // Found

// Encapsulation – change private field through setter and access through getter
$p1->setDiagnosis("Migraine");
echo "<br>Updated diagnosis for {$p1->surname}: {$p1->getDiagnosis()}<br><br>";

// Create tow new objects to demonstrate static method showObjects
$p4 = new Patient();
$p4->setSurname("Kovalenko");
$p4->setAge(55);
$p4->setMedicalCardNumber("MC99999");
$p4->setDiagnosis("Allergy");

$p5 = new Patient();
$p5->setSurname("Hrytsenko");
$p5->setAge(28);
$p5->setMedicalCardNumber("MC77777");
$p5->setDiagnosis("Asthma");

// Create an array of 5 patients
$patients = [
  $p1,
  $p2,
  $p3,
  $p4,
  $p5
];

// Show all patients
echo "<hr>List of all patients:<br>";
Patient::showObjects($patients);
