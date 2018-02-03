<?php

namespace Entities;

/**
 * @Entity @Table(name="artist")
 **/
class Artist
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @name @Column(type="string") **/
    private $name;

    /** @genre_id @Column(type="integer") **/
    private $genre_id;

    /** @name @Column(type="boolean") **/
    private $active;

}