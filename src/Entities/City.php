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

    /**
     * @ManyToOne(targetEntity="State")
     * @JoinColumn(name="state_id", referencedColumnName="id")
     */
    private $state;

    /** @uf @Column(type="string") **/
    private $uf;

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
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStateId()
    {
        return $this->state_id;
    }

    /**
     * @param mixed $state_id
     * @return City
     */
    public function setStateId($state_id)
    {
        $this->state_id = $state_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param mixed $uf
     * @return City
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     * @return City
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

}