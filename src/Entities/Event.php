<?php

namespace Entities;

/**
 * @Entity @Table(name="event")
 **/
class Event
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Show")
     * @JoinColumn(name="show_id", referencedColumnName="id")
     */
    private $show;

    /**
     * @ManyToOne(targetEntity="Venue")
     * @JoinColumn(name="venue_id", referencedColumnName="id")
     */
    private $venue;

    /** @event_date @Column(type="datetime") **/
    private $event_date;

    /** @sales_start_date @Column(type="date") **/
    private $sales_start_date;
    
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
    public function getEventDate()
    {
        return $this->event_date;
    }

    /**
     * @param mixed $event_date
     * @return Event
     */
    public function setEventDate($event_date)
    {
        $this->event_date = $event_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalesStartDate()
    {
        return $this->sales_start_date;
    }

    /**
     * @param mixed $sales_start_date
     * @return Event
     */
    public function setSalesStartDate($sales_start_date)
    {
        $this->sales_start_date = $sales_start_date;
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
     * @return Event
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * @param mixed $show
     * @return Event
     */
    public function setShow($show)
    {
        $this->show = $show;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * @param mixed $venue
     * @return Event
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;
        return $this;
    }

}