<?php

namespace Entities;

/**
 * @Entity @Table(name="genre")
 **/
class Genre
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @name @Column(type="string") **/
    private $name;

    /** @name @Column(type="boolean") **/
    private $active;    

}