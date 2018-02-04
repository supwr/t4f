<?php

namespace Entities;

/**
 * @Entity @Table(name="ticket")
 **/
class Ticket
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @name @Column(type="string") **/
    private $name;

    /** @description @Column(type="text") **/
    private $description;

    /** @active @Column(type="boolean") **/
    private $active;

}