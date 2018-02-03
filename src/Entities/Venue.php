<?php

namespace Entities;

/**
 * @Entity @Table(name="venue")
 **/
class Venue
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @name @Column(type="string") **/
    private $name;

    /** @name @Column(type="string") **/
    private $city_id;    

    /** @name @Column(type="boolean") **/
    private $active;

}