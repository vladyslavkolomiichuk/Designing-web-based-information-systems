<?php

use app\models\Patient;

class PatientSearchCest
{
  // Runs before each test
  public function _before(\FunctionalTester $I)
  {
    Patient::deleteAll(); // Clear all patients before tests

    // Add patients for filter testing
    (new Patient(['name' => 'Target Person', 'diagnosis' => 'Unique A', 'birth_date' => '2000-01-01']))->save(false);
    (new Patient(['name' => 'Noise Person', 'diagnosis' => 'Unique B', 'birth_date' => '1990-01-01']))->save(false);

    // Nothing else needed here; test methods will navigate to pages
  }

  // Filter by name
  public function filterByName(\FunctionalTester $I)
  {
    // FIX: Instead of submitForm, navigate directly to URL with search params
    // This emulates GET filter in GridView
    $I->amOnRoute('patient/index', [
      'PatientSearch' => ['name' => 'Target']
    ]);

    // Verify results
    $I->see('Target Person');
    $I->dontSee('Noise Person');
  }

  // Filter by diagnosis
  public function filterByDiagnosis(\FunctionalTester $I)
  {
    // FIX: Same approach for diagnosis
    $I->amOnRoute('patient/index', [
      'PatientSearch' => ['diagnosis' => 'Unique B']
    ]);

    // Verify results
    $I->see('Noise Person');
    $I->dontSee('Target Person');
  }
}
