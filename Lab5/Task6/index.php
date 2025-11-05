<?php
// ===== Patient class =====
class Patient
{
  public $age;
  public $surname;
  public $medicalCardNumber;
  private $diagnosis;

  // Setters
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

  // Getters
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

  // Display patient info
  public function show()
  {
    $this->privateMessage(); // internal log
    echo "Patient's surname: {$this->surname}. Age: {$this->age}. Medical card number: {$this->medicalCardNumber}. Diagnosis: {$this->diagnosis}<br>";
  }

  // Search by surname
  public function searchBySurname($value)
  {
    if (strcasecmp($this->surname, $value) == 0) {
      echo "Patient found: ";
      $this->show();
      return true;
    } else {
      echo "Patient with surname {$value} not found<br>";
      return false;
    }
  }

  // Internal message (private)
  private function privateMessage()
  {
    echo "(Private message: patient data displayed successfully)<br>";
  }

  // Display multiple patients
  public static function showObjects($patients)
  {
    foreach ($patients as $p) {
      $p->show();
    }
  }
}

// ===== Factory class =====
class PatientFactory
{
  // Factory method creates and initializes Patient objects
  public static function create($surname, $age, $medicalCardNumber, $diagnosis)
  {
    $patient = new Patient();
    $patient->setSurname($surname);
    $patient->setAge($age);
    $patient->setMedicalCardNumber($medicalCardNumber);
    $patient->setDiagnosis($diagnosis);
    return $patient;
  }
}

// ===== Demonstration =====

// Create patients via Factory
$p1 = PatientFactory::create("Ivanenko", 25, "MC12345", "Flu");
$p2 = PatientFactory::create("Petrenko", 40, "MC67890", "Hypertension");
$p3 = PatientFactory::create("Sydorenko", 32, "MC54321", "Diabetes");

// Display info
$p1->show();
$p2->show();
$p3->show();

// Search by surname
echo "<br>Searching for 'Petrenko':<br>";
$p1->searchBySurname("Petrenko"); // Not found
$p2->searchBySurname("Petrenko"); // Found

// Update diagnosis (demonstrate encapsulation)
$p1->setDiagnosis("Migraine");
echo "<br>Updated diagnosis for {$p1->surname}: {$p1->getDiagnosis()}<br><br>";

// Create additional patients via Factory
$p4 = PatientFactory::create("Kovalenko", 55, "MC99999", "Allergy");
$p5 = PatientFactory::create("Hrytsenko", 28, "MC77777", "Asthma");

// Array of all patients
$patients = [$p1, $p2, $p3, $p4, $p5];

// Display all patients
echo "<hr>List of all patients:<br>";
Patient::showObjects($patients);
