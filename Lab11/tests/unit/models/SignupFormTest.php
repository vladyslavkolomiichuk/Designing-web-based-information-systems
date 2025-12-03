<?php

namespace tests\unit\models;

use app\models\SignupForm;
use app\models\User;
use Yii;

class SignupFormTest extends \Codeception\Test\Unit
{
    // Runs before each test
    protected function _before()
    {
        // Safe to run because we are using 'auth-php-test' database
        User::deleteAll();
    }

    // Test 1: Empty fields validation
    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'username' => '',
            'email' => '',
            'password' => '',
        ]);

        verify($model->signup())->null();
        verify($model->errors)->arrayHasKey('username');
        verify($model->errors)->arrayHasKey('email');
        verify($model->errors)->arrayHasKey('password');
    }

    // Test 2: Successful registration
    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'test_user',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $user = $model->signup();

        // Check if user object is returned
        verify($user)->notNull();
        verify($user->username)->equals('test_user');

        // Check if data is actually inside MongoDB
        $savedUser = User::findOne(['email' => 'test@example.com']);
        verify($savedUser)->notNull();
        verify($savedUser->validatePassword('password123'))->true();
    }

    // Test 3: Duplicate email validation
    public function testDuplicateEmail()
    {
        // Create first user
        $user = new User();
        $user->username = 'first_user';
        $user->email = 'duplicate@example.com';
        $user->setPassword('123456');
        $user->generateAuthKey();
        $user->save();

        // Try to create second user with same email
        $model = new SignupForm([
            'username' => 'second_user',
            'email' => 'duplicate@example.com',
            'password' => 'newpassword',
        ]);

        verify($model->signup())->null();
        verify($model->errors)->arrayHasKey('email');
        verify($model->getFirstError('email'))->equals('This email address has already been taken.');
    }
}
