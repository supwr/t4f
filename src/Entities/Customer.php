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

}