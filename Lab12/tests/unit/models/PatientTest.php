<?php

namespace tests\unit\models;

use app\models\Patient;

class PatientTest extends \Codeception\Test\Unit
{
  // Runs before each test
  protected function _before()
  {
    // Clear the test collection
    Patient::deleteAll();
  }

  // Test 1: Validation should fail if required fields are empty
  public function testValidateEmpty()
  {
    $model = new Patient();

    // Validate empty model
    verify($model->validate())->false();

    // Check errors for required fields
    verify($model->errors)->arrayHasKey('name');
    verify($model->errors)->arrayHasKey('diagnosis');
    verify($model->errors)->arrayHasKey('birth_date');
  }

  // Test 2: Validation should pass with correct data
  public function testValidateCorrect()
  {
    $model = new Patient();
    $model->name = 'John Doe';
    $model->diagnosis = 'Healthy';
    $model->birth_date = '1990-01-01';

    // Validation should pass
    verify($model->validate())->true();
  }

  // Test 3: Saving to MongoDB
  public function testSave()
  {
    $model = new Patient();
    $model->name = 'Saved Patient';
    $model->diagnosis = 'Flu';
    $model->birth_date = '2000-05-20';

    // Save returns true
    verify($model->save())->true();

    // Check if patient exists in DB
    $savedPatient = Patient::findOne(['name' => 'Saved Patient']);
    verify($savedPatient)->notNull();
    verify($savedPatient->diagnosis)->equals('Flu');
  }
}
