<?php

namespace Entities;

/**
 * @Entity @Table(name="state")
 **/
class State
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @name @Column(type="string") **/
    private $name;

    /** @uf @Column(type="string") **/
    private $uf;

}