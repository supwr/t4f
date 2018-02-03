<?php

namespace Entities;

/**
 * @Entity @Table(name="customer")
 **/
class Customer
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @code @Column(type="string") **/
    private $code;

    /** @name @Column(type="string") **/
    private $name;

    /** @name @Column(type="boolean") **/
    private $active;

}