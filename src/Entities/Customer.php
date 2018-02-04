<?php

namespace Entities;

/**
 * @Entity @Table(name="customer")
 **/
class Customer
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @first_name @Column(type="string") **/
    private $first_name;

    /** @last @Column(type="string") **/
    private $last_name;

    /** @email @Column(type="string") **/
    private $email;

    /** @pwd @Column(type="string") **/
    private $pwd;

    /** @name @Column(type="boolean") **/
    private $active;

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
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     * @return Customer
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     * @return Customer
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     * @return Customer
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return Customer
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }



}