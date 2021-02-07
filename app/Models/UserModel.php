<?php
/* Recipe Model Object */
namespace App\Models;

class UserModel {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $username;
    private $password;
    private $role;
    private $active;

    public function __construct($id, $firstName, $lastName, $email, $username, $password, $role, $active) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
    * @param mixed $username
    */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
    * @param mixed $password
    */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
    * @param mixed $role
    */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
    * @param mixed $active
    */
    public function setActive($active)
    {
        $this->active = $active;
    }
}
