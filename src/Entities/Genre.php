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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Genre
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

}