<?php

namespace Entities;

/**
 * @Entity @Table(name="sector")
 **/
class Sector
{

    /** @id @Column(type="integer") @GeneratedValue * */
    private $id;

    /**
     * @ManyToOne(targetEntity="Event")
     * @JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    /** @name @Column(type="string") * */
    private $name;

    /** @description @Column(type="text") * */
    private $description;

    /** @seats @Column(type="integer") * */
    private $seats;

    /** @seat_price @Column(type="float", precision=10, scale=2) * */
    private $seat_price;

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
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     * @return Sector
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
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
     * @return Sector
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Sector
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param mixed $seats
     * @return Sector
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeatPrice()
    {
        return $this->seat_price;
    }

    /**
     * @param mixed $seat_price
     * @return Sector
     */
    public function setSeatPrice($seat_price)
    {
        $this->seat_price = $seat_price;
        return $this;
    }
}