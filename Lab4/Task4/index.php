<?php

// Trait for storing and displaying personal information about a patient
trait PersonalInfoTrait
{
  public $surname;
  public $age;
  public $cardNumber;

  // Method to set the patient's basic information
  public function setPersonalData($surname, $age, $cardNumber)
  {
    $this->surname = $surname;
    $this->age = $age;
    $this->cardNumber = $cardNumber;
  }

  // Method to display the patient's personal data
  public function showPersonalData()
  {
    echo "Patient: {$this->surname}, Age: {$this->age}, Card number: {$this->cardNumber}<br>";
  }
}

// Trait for handling and displaying diagnosis information
trait DiagnosisTrait
{
  public $diagnosis;

  // Method to set the patient's diagnosis
  public function setDiagnosis($diagnosis)
  {
    $this->diagnosis = $diagnosis;
  }

  // Method to display the patient's diagnosis
  public function showDiagnosis()
  {
    echo "Diagnosis: {$this->diagnosis}<br>";
  }
}

// Trait for logging actions to a text file
trait LoggerTrait
{
  // Method to write an action with a timestamp to the log file
  public function logAction($action, $fileName)
  {
    // Current date and time
    $date = date("F j, Y, g:i a");

    // Format the log entry
    $entry = "$date: $action\n";

    // Append to the file
    file_put_contents($fileName, $entry, FILE_APPEND);
    echo "Action '{$action}' has been logged.<br>";
  }
}

class Patient
{
  use PersonalInfoTrait, DiagnosisTrait, LoggerTrait;

  // Method to display all patient information
  public function showFullInfo()
  {
    $this->showPersonalData();
    $this->showDiagnosis();
  }
}

// Create an instance of the Patient class
$patient = new Patient();

// Set personal data and diagnosis
$patient->setPersonalData("Shevchenko", 35, "A12345");
$patient->setDiagnosis("Flu");

// Display all patient information
$patient->showFullInfo();

// Log some actions related to the patient
$patient->logAction("Patient {$patient->surname} has been added to the database", "patient_log.txt");
$patient->logAction("Diagnosis updated for {$patient->surname}", "patient_log.txt");
