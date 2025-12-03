<?php

namespace tests\unit\models;

use app\models\Patient;
use app\models\PatientSearch;

class PatientSearchTest extends \Codeception\Test\Unit
{
  // Runs before each test
  protected function _before()
  {
    Patient::deleteAll(); // Clear all patients before tests

    // Create test data
    $p1 = new Patient(['name' => 'Anna Smith', 'diagnosis' => 'Flu', 'birth_date' => '1990-01-01']);
    $p1->save(false);

    $p2 = new Patient(['name' => 'Bob Jones', 'diagnosis' => 'Cold', 'birth_date' => '1995-05-05']);
    $p2->save(false);

    $p3 = new Patient(['name' => 'Anna Taylor', 'diagnosis' => 'Flu', 'birth_date' => '2000-10-10']);
    $p3->save(false);
  }

  // Test search by name
  public function testSearchByName()
  {
    $searchModel = new PatientSearch();

    $dataProvider = $searchModel->search(['PatientSearch' => ['name' => 'Anna']]);
    verify($dataProvider->getCount())->equals(2);

    $models = $dataProvider->getModels();
    $this->assertStringContainsString('Anna', $models[0]->name);

    $dataProvider = $searchModel->search(['PatientSearch' => ['name' => 'Bob']]);
    verify($dataProvider->getCount())->equals(1);
  }

  // Test search by diagnosis
  public function testSearchByDiagnosis()
  {
    $searchModel = new PatientSearch();

    $dataProvider = $searchModel->search(['PatientSearch' => ['diagnosis' => 'Flu']]);
    verify($dataProvider->getCount())->equals(2);

    $models = $dataProvider->getModels();
    $this->assertStringContainsString('Anna', $models[0]->name);
  }

  // Test search with no results
  public function testSearchEmptyResult()
  {
    $searchModel = new PatientSearch();

    $dataProvider = $searchModel->search(['PatientSearch' => ['name' => 'Zorro']]);
    verify($dataProvider->getCount())->equals(0);
  }
}
