<?php

use app\models\User;

class SignupCest
{
    public function _before(\FunctionalTester $I)
    {
        User::deleteAll();
        $I->amOnRoute('auth/signup');
    }

    public function openSignupPage(\FunctionalTester $I)
    {
        $I->see('Sign Up', 'h1');
        $I->see('Please fill out the following fields to signup:');
    }

    public function signupWithEmptyFields(\FunctionalTester $I)
    {
        $I->submitForm('#form-signup', []);
        $I->see('Username cannot be blank.');
        $I->see('Email cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function signupSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#form-signup', [
            'SignupForm[username]' => 'newuser',
            'SignupForm[email]'    => 'new@example.com',
            'SignupForm[password]' => 'password123',
        ]);

        $I->expectTo('be logged in automatically');
        $I->see('Logout (newuser)');
    }
}
