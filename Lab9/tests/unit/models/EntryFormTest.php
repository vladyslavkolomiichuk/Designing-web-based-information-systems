<?php

namespace tests\unit\models;

use app\models\EntryForm;

class EntryFormTest extends \Codeception\Test\Unit
{
  public function testValidationFailsOnEmptyFields()
  {
    $model = new EntryForm(); // New model

    $model->name = '';
    $model->email = '';

    $this->assertFalse($model->validate()); // Should fail
  }

  public function testValidationFailsOnInvalidEmail()
  {
    $model = new EntryForm();

    $model->name = 'John';
    $model->email = 'not-email'; // Invalid email

    $this->assertFalse($model->validate()); // Should fail
  }

  public function testValidationPassesOnCorrectData()
  {
    $model = new EntryForm();

    $model->name = 'John';
    $model->email = 'john@gmail.com'; // Valid data

    $this->assertTrue($model->validate()); // Should pass
  }
}
