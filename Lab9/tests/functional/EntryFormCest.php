<?php

namespace tests\functional;

use app\models\EntryForm;
use FunctionalTester;

class EntryFormCest
{
  public function checkEntryPageLoads(FunctionalTester $I)
  {
    $I->amOnPage('/index.php?r=site/entry'); // Open entry page
    $I->see('Name');  // Check name field label
    $I->see('Email'); // Check email field label
  }

  public function checkFormSubmit(FunctionalTester $I)
  {
    $I->amOnPage('/index.php?r=site/entry'); // Open form

    $I->fillField('EntryForm[name]', 'John');           // Fill name
    $I->fillField('EntryForm[email]', 'john@gmail.com'); // Fill email
    $I->click('Submit');                                // Submit form

    $I->see('You entered:'); // Check confirmation page
    $I->see('John');
    $I->see('john@gmail.com');
  }
}
