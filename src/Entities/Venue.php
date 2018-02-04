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

    /**
     * @ManyToOne(targetEntity="City")
     * @JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

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
     * @return Venue
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return Venue
     */
    public function setCity($city)
    {
        $this->city = $city;
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
     * @return Venue
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

}