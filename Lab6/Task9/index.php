<?php
// ================= Patient Class =================
class Patient
{
  public $surname;
  public $age;
  public $cardNumber;

  public function __construct($surname, $age, $cardNumber)
  {
    $this->surname = $surname;
    $this->age = $age;
    $this->cardNumber = $cardNumber;
  }

  public function getInfo()
  {
    return "Patient: {$this->surname}, age: {$this->age}, card: {$this->cardNumber}";
  }
}


// ================= External Services =================

// Example service that prints patient info
class PatientPrinter
{
  public function printPatient(Patient $p)
  {
    echo "Printing patient info: " . $p->getInfo() . "<br/>";
  }
}

// Another service that saves patient (simulated)
class PatientSaver
{
  public function savePatient(Patient $p)
  {
    echo "Saving patient to database: " . $p->getInfo() . "<br/>";
  }
}


// ================= Adapter Interface =================
interface IPatientAdapter
{
  public function processPatient(Patient $p);
}


// ================= Adapter Classes =================

// Adapter for printing patient
class PrinterAdapter implements IPatientAdapter
{
  private $service;

  public function __construct()
  {
    $this->service = new PatientPrinter(); // internal service
  }

  public function processPatient(Patient $p)
  {
    $this->service->printPatient($p); // unified interface
  }
}

// Adapter for saving patient
class SaverAdapter implements IPatientAdapter
{
  private $service;

  public function __construct()
  {
    $this->service = new PatientSaver(); // internal service
  }

  public function processPatient(Patient $p)
  {
    $this->service->savePatient($p); // unified interface
  }
}


// ================= Client / Demonstration =================
echo "<h3>Patient Adapter Demonstration</h3>";

$patient1 = new Patient("Ivanenko", 40, "A-100");
$patient2 = new Patient("Petrenko", 35, "A-101");

// Using printer adapter
$printerAdapter = new PrinterAdapter();
$printerAdapter->processPatient($patient1);
$printerAdapter->processPatient($patient2);

// Using saver adapter
$saverAdapter = new SaverAdapter();
$saverAdapter->processPatient($patient1);
$saverAdapter->processPatient($patient2);
