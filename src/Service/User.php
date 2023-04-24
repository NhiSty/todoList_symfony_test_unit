<?php

namespace App\Service;

class User
{

    public function __construct(
        private ?string    $email = null,
        private ?string    $firstName = null,
        private ?string    $lastName = null,
        private ?string    $password = null,
        private ?\DateTime $birthday = null,

    )
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->birthday = $birthday;

        if (self::isUserValid()) {
            $this->todoList = new TodoList();
        }

    }

    /**
     * @return \DateTime|null
     */
    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime|null $birthday
     */
    public function setBirthday(?\DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    private TodoList $todoList;

    /**
     * @return TodoList | string
     */
    public function getTodoList(): TodoList | string
    {
        if (self::isUserValid()) {
            return $this->todoList;
        }
        return 'user is not valid';
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function isPasswordValid(string $password): bool
    {
        return
            strlen($password) >= 8
            && strlen($password) <= 40 // min 8 characters and max 40 characters
            && preg_match('/[A-Z]/', $password) // 1 uppercase
            && preg_match('/[0-9]/', $password) // 1 number
            && preg_match('/[a-z]/', $password); // 1 lowercase
    }

    public function isFnameValid(string $value): bool
    {
        if (empty($value)) {
            return false;
        }
        return true;
    }

    public function isLnameValid(string $value): bool
    {
        if (empty($value)) {
            return false;
        }
        return true;
    }

    public function isEmailValid(string $email): bool
    {
        if (empty($email)) {
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public function isBirthdayValid(\DateTime $birthday): bool
    {
        $today = new \DateTime();
        $interval = $today->diff($birthday);

        return $interval->y >= 13;
    }

    public function isUserValid(): bool
    {
        return
            $this->isEmailValid($this->email)
            && $this->isFnameValid($this->firstName)
            && $this->isLnameValid($this->lastName)
            && $this->isPasswordValid($this->password)
            && $this->isBirthdayValid($this->birthday);
    }


}
