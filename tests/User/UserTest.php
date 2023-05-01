<?php

namespace App\Tests\User;

use App\Service\EmailSender;
use App\Service\User;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->user = new User(
            'user@test.com',
            'John',
            'Doe',
            'Test1234',
            new \DateTime('now' . '- 13 years')
        );


    }

    public function testEmailIsValid(): void
    {
        // true because it's not empty
        $this->assertTrue($this->user->isEmailValid($this->user->getEmail()));

        // false because empty string
        $this->user->setEmail('');
        $this->assertFalse($this->user->isEmailValid($this->user->getEmail()));

        // false because email not valid
        $this->assertFalse($this->user->isEmailValid('test'));
        $this->assertFalse($this->user->isEmailValid('test@test'));
        $this->assertFalse($this->user->isEmailValid('test@test.'));


    }

    public function testIsFirstNameValid(): void
    {
        // true because it's not empty
        $this->assertTrue($this->user->isFnameValid($this->user->getFirstName()));

        // false because empty string
        $this->user->setFirstName('');
        $this->assertFalse($this->user->isFnameValid($this->user->getFirstName()));

    }

    public function testIsLastNameValid(): void
    {
        // true because it's not empty
        $this->assertTrue($this->user->isLnameValid($this->user->getLastName()));

        // false because empty string
        $this->user->setLastName('');
        $this->assertFalse($this->user->isLnameValid($this->user->getLastName()));

    }

    /**
     * @throws Exception
     */
    public function testisBirthdayValid(): void
    {
        // true because birthday is greater or equal to 13 years
        $this->assertTrue($this->user->isBirthdayValid($this->user->getBirthday()));

        // false because birthday is in the future
        $this->user->setBirthday(new \DateTime('now' . '+ 1 day'));
        $this->assertFalse($this->user->isBirthdayValid($this->user->getBirthday()));

        // false because birthday is lesser than 13 years
        $this->user->setBirthday(new \DateTime('now' . '- 12 years'));
        $this->assertFalse($this->user->isBirthdayValid($this->user->getBirthday()));

    }

    public function testIsPasswordValid(): void
    {
        // true because password is valid
        $this->assertTrue($this->user->isPasswordValid($this->user->getPassword()));

        // false because password is lesser than 8 characters
        $this->user->setPassword('test');
        $this->assertFalse($this->user->isPasswordValid($this->user->getPassword()));

        // false because doesn't contain at least one uppercase letter
        $this->user->setPassword('test1234');
        $this->assertFalse($this->user->isPasswordValid($this->user->getPassword()));

        // false because doesn't contain at least one lowercase letter
        $this->user->setPassword('TEST1234');
        $this->assertFalse($this->user->isPasswordValid($this->user->getPassword()));

        //false because it contains more than 40 characters
        $this->user->setPassword('Test1becauseitcontainstoomanycharactersanditshouldnotwork');
        $this->assertFalse($this->user->isPasswordValid($this->user->getPassword()));
    }

    public function testIsUserValid(): void
    {
        // true cause all data are valid (email, first name, last name, birthday) see setUp()
        $this->assertTrue($this->user->isUserValid());

        // false cause email is not valid
        $this->user->setEmail('test');
        $this->assertFalse($this->user->isUserValid());

        // false cause first name is not valid
        $this->user->setFirstName('');
        $this->assertFalse($this->user->isUserValid());

        // false cause last name is not valid
        $this->user->setLastName('');
        $this->assertFalse($this->user->isUserValid());
    }

    public function testUserHaveAToDoList(): void
    {   // Return a ToDoList object beacause user is valid
        $this->assertIsObject($this->user->getToDoList());

        // don't have a ToDolist because user is not valid (email is wrong)
        $this->user = new User(
            'user@test',
            'John',
            'Doe',
            'Test1234',
            new \DateTime('now' . '- 13 years')
        );
        $this->assertEquals('user is not valid', $this->user->getToDoList());
    }

    //TODO test the add ToDoList & ItemTest classes in /tests/Item/ItemTest.php
    // and /tests/ToDoList/ToDoListTest.php
    // and the email action (at 8 items in the todolist, send an email)
}

