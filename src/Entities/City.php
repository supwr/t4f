<?php

namespace Entities;

/**
 * @Entity @Table(name="city")
 **/
class City
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @name @Column(type="string") **/
    private $name;

    /** @state_id @Column(type="integer") **/
    private $state_id;

    /** @uf @Column(type="string") **/
    private $uf;

}