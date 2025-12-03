<?php

use app\models\Patient;
use yii\helpers\Url; // <--- REQUIRED: add this line

class PatientCest
{
  // Runs before each test
  public function _before(\FunctionalTester $I)
  {
    Patient::deleteAll(); // Clear all patients before each test
  }

  // Test creating a patient
  public function createPatient(\FunctionalTester $I)
  {
    $I->amOnRoute('patient/create');
    $I->see('New Patient', 'h1');

    $I->submitForm('form', [
      'Patient[name]' => 'Functional Test User',
      'Patient[diagnosis]' => 'Testing Syndrome',
      'Patient[birth_date]' => '1985-10-10',
    ]);

    $I->see('Functional Test User', 'h1');
    $I->see('Testing Syndrome');
    $I->see('1985-10-10');
  }

  // Test index page display
  public function viewIndexPage(\FunctionalTester $I)
  {
    $patient = new Patient();
    $patient->name = 'Index User';
    $patient->diagnosis = 'Cold';
    $patient->birth_date = '1999-12-31';
    $patient->save(false);

    $I->amOnRoute('patient/index');
    $I->see('Patients', 'h1');
    $I->see('Index User');
    $I->see('Cold');
  }

  // Test updating a patient
  public function updatePatient(\FunctionalTester $I)
  {
    $patient = new Patient();
    $patient->name = 'Old Name';
    $patient->diagnosis = 'Old Diagnosis';
    $patient->birth_date = '1990-01-01';
    $patient->save(false);

    $I->amOnRoute('patient/update', ['_id' => (string)$patient->_id]);
    $I->see('Edit: Old Name', 'h1');

    $I->submitForm('form', [
      'Patient[name]' => 'New Name',
      'Patient[diagnosis]' => 'New Diagnosis',
    ]);

    $I->see('New Name', 'h1');
    $I->see('New Diagnosis');
    $I->dontSee('Old Name');
  }

  // Test validation messages
  public function checkValidation(\FunctionalTester $I)
  {
    $I->amOnRoute('patient/create');
    $I->submitForm('form', []);

    $I->see('Name cannot be blank');
    $I->see('Diagnosis cannot be blank');
    $I->see('Birth Date cannot be blank');
  }

  // Test deleting a patient
  public function deletePatient(\FunctionalTester $I)
  {
    $patient = new Patient();
    $patient->name = 'To Be Deleted';
    $patient->diagnosis = 'Fatal Error';
    $patient->birth_date = '2020-02-02';
    $patient->save(false);

    $id = (string)$patient->_id;

    $I->amOnRoute('patient/index');
    $I->see('To Be Deleted');

    // --- FIXED HERE ---
    // Generate string URL from array
    $url = Url::to(['patient/delete', '_id' => $id]);

    // Send string URL via AJAX instead of array
    $I->sendAjaxRequest('POST', $url);

    $I->amOnRoute('patient/index');
    $I->dontSee('To Be Deleted');
  }
}
