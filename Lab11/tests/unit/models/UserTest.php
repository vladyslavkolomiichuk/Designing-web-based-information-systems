<?php

namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
        // Clear DB before each test
        User::deleteAll();

        // Create a seed user
        $user = new User();
        $user->username = 'test_user';
        $user->email = 'test@example.com';
        $user->setPassword('password123');
        $user->generateAuthKey();
        $user->save();
    }

    public function testFindUserById()
    {
        // Find the created user first to get ID
        $user = User::findByUsername('test_user');
        $userId = $user->getId();

        // Test findIdentity
        $foundUser = User::findIdentity($userId);

        verify($foundUser)->notNull();
        verify($foundUser->username)->equals('test_user');
    }

    public function testFindUserByUsername()
    {
        verify(User::findByUsername('test_user'))->notNull();
        verify(User::findByUsername('non_existing_user'))->null();
    }

    public function testValidatePassword()
    {
        $user = User::findByUsername('test_user');

        verify($user->validatePassword('password123'))->true();
        verify($user->validatePassword('wrong_password'))->false();
    }

    public function testValidateAuthKey()
    {
        $user = User::findByUsername('test_user');
        $authKey = $user->getAuthKey();

        verify($user->validateAuthKey($authKey))->true();
        verify($user->validateAuthKey('random_string'))->false();
    }
}
