<?php
class PatientPrototype
{
  public $surname;
  public $age;
  public $cardNumber;

  public function __clone()
  {
    // clone customization if needed
  }
}

// ======= DEMONSTRATION =======
$proto = new PatientPrototype();
$proto->surname = "Ivanenko";
$proto->age = 40;
$proto->cardNumber = "A-100";

$patient1 = clone $proto; // clone patient template
$patient1->surname = "Petrenko"; // change only needed fields

$patient2 = clone $proto;
$patient2->cardNumber = "A-101";

echo "Patient 1: $patient1->surname, age $patient1->age, card $patient1->cardNumber<br>";
echo "Patient 2: $patient2->surname, age $patient2->age, card $patient2->cardNumber<br>";
