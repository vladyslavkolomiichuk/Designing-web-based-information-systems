<?php

/**
 * Abstract patient handler
 */
abstract class PatientHandler
{
  /**
   * @var PatientHandler
   */
  protected $next;

  /**
   * @param PatientHandler $handler
   * @return PatientHandler
   */
  public function setNext($handler)
  {
    $this->next = $handler;
    return $handler;
  }

  /**
   * @param array $patient
   * @return void
   */
  abstract public function check($patient);
}

/**
 * Check patient age
 */
class AgeCheckHandler extends PatientHandler
{
  /**
   * @param array $patient
   */
  public function check($patient)
  {
    if ($patient['age'] >= 18) {
      if ($this->next) {
        $this->next->check($patient);
      } else {
        echo "Patient accepted.";
      }
    } else {
      echo "Patient rejected. Age restriction.";
    }
  }
}

/**
 * Check card number
 */
class CardNumberCheckHandler extends PatientHandler
{
  /**
   * @param array $patient
   */
  public function check($patient)
  {
    if (!empty($patient['card'])) {
      if ($this->next) {
        $this->next->check($patient);
      } else {
        echo "Patient accepted.";
      }
    } else {
      echo "Patient rejected. Medical card number missing.";
    }
  }
}

// Usage example
$patient = [
  'age' => 25,
  'surname' => 'Kovalenko',
  'card' => 'MC-45231'
];

$age = new AgeCheckHandler();
$card = new CardNumberCheckHandler();

$age->setNext($card);
$age->check($patient);
