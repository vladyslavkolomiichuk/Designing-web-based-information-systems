<?php
class Patient
{
  public $age;
  public $surname;
  public $medicalCardNumber;

  private $diagnosis;

  // Constructor to create an object
  public function __construct($surname, $age, $medicalCardNumber, $diagnosis)
  {
    $this->surname = $surname;
    $this->age = $age;
    $this->medicalCardNumber = $medicalCardNumber;
    $this->diagnosis = $diagnosis;
  }

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

  // Convert patient to an array (for CSV)
  public function toArray()
  {
    return [$this->surname, $this->age, $this->medicalCardNumber, $this->diagnosis];
  }

  // Build patient from a CSV row
  public static function fromArray(array $row)
  {
    return new Patient($row[0], $row[1], $row[2], $row[3]);
  }
}

class CSV
{
  protected $csvFile = null;

  public function __construct($csv_file)
  {
    if (file_exists($csv_file)) {

      $this->csvFile = $csv_file;
    } else {
      throw new Exception("File not found");
    }
  }

  public function setCSV(array $csv)
  {
    $handle = fopen($this->csvFile, "a"); // Open the file for writing

    foreach ($csv as $value) {
      fputcsv($handle, explode(";", $value), ";");
    }
    fclose($handle);
  }

  public function getCSV()
  {
    $handle = fopen($this->csvFile, "r"); // Open the file for reading 

    $array_line_full = array();
    while (($line = fgetcsv($handle, 0, ";")) !== FALSE) {
      $array_line_full[] = $line;
    }
    fclose($handle);
    return $array_line_full;
  }
}

class PatientCSV extends CSV
{
  // Add a Patient object to the CSV
  public function addPatient(Patient $patient)
  {
    $handle = fopen($this->csvFile, "a");
    if (!$handle) {
      throw new Exception("Cannot open file for writing");
    }
    fputcsv($handle, $patient->toArray(), ";");
    fclose($handle);
  }

  // Remove a Patient object from the CSV
  public function removePatient(Patient $patient)
  {
    // Load all patients as Patient objects
    $rows = $this->getCSV();

    $filtered = array_filter($rows, function ($row) use ($patient) {
      // Remove only if all fields match exactly
      return !(
        $row[0] === $patient->surname &&
        $row[1] == $patient->age &&
        $row[2] === $patient->medicalCardNumber &&
        $row[3] === $patient->getDiagnosis()
      );
    });

    // Rewrite the CSV without the removed patient
    $handle = fopen($this->csvFile, "w");
    foreach ($filtered as $row) {
      fputcsv($handle, $row, ";");
    }
    fclose($handle);
  }

  // Get all patients from CSV as Patient objects
  public function getPatients()
  {
    // Load all patients as Patient objects
    $rows = $this->getCSV();

    // Make an array with objects Patient by using fromArray
    $patients = [];
    foreach ($rows as $row) {
      $patients[] = Patient::fromArray($row);
    }
    return $patients;
  }
}

try {
  $csv = new PatientCSV("file.csv");

  $csv->addPatient(new Patient("Ivanenko", 25, "MC12345", "Flu"));
  $csv->addPatient(new Patient("Petrenko", 40, "MC67890", "Hypertension"));
  $csv->addPatient(new Patient("Sydorenko", 32, "MC54321", "Diabetes"));
  $csv->addPatient(new Patient("Kovalenko", 55, "MC99999", "Allergy"));
  $csv->addPatient(new Patient("Hrytsenko", 28, "MC77777", "Asthma"));

  echo "All patients<br>";
  $patients = $csv->getPatients();
  Patient::showObjects($patients);

  $csv->removePatient(new Patient("Sydorenko", 32, "MC54321", "Diabetes"));

  echo "<br><br><hr><br><br>Remove Sydorenko<br>";
  $patients = $csv->getPatients();
  Patient::showObjects($patients);
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
