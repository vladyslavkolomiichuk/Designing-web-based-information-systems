<?php

namespace tests\unit\models;

use app\models\LoginForm;
use app\models\User;
use Yii;

class LoginFormTest extends \Codeception\Test\Unit
{
    // Runs before each test
    protected function _before()
    {
        User::deleteAll();

        // Create a user manually in the database to test login against
        $user = new User();
        $user->username = 'demo_login';
        $user->email = 'demo@login.com';
        $user->setPassword('correct-password');
        $user->generateAuthKey();
        $user->save();
    }

    // Runs after each test
    protected function _after()
    {
        Yii::$app->user->logout();
    }

    // Test 1: Wrong password
    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'demo_login',
            'password' => 'wrong-password',
        ]);

        verify($model->login())->false();
        verify($model->errors)->arrayHasKey('password');
        verify(Yii::$app->user->isGuest)->true();
    }

    // Test 2: Non-existent user
    public function testLoginNonExistentUser()
    {
        $model = new LoginForm([
            'username' => 'ghost_user',
            'password' => 'any_password',
        ]);

        verify($model->login())->false();
        verify(Yii::$app->user->isGuest)->true();
    }

    // Test 3: Correct login
    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'username' => 'demo_login',
            'password' => 'correct-password',
        ]);

        verify($model->login())->true();
        verify($model->errors)->arrayHasNotKey('password');
        verify(Yii::$app->user->isGuest)->false();
    }
}
