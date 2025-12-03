<?php

use app\models\User;

class LoginCest
{
    // Executed before each test
    public function _before(\FunctionalTester $I)
    {
        // Create a user in the test database
        User::deleteAll();

        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@example.com';
        $user->setPassword('admin123');
        $user->generateAuthKey();
        $user->save();

        // Go to login page
        $I->amOnRoute('auth/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');
        $I->see('Please fill out the following fields to login:');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validation error');
        $I->see('Incorrect username or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin123',
        ]);

        $I->expectTo('see user info');
        $I->see('Logout (admin)'); // Checks if Logout button appears in Navbar
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Sign Up');
    }
}
