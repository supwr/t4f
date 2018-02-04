<?php

namespace Entities;

/**
 * @Entity @Table(name="event_ticket")
 **/
class EventTicket
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Ticket")
     * @JoinColumn(name="ticket_id", referencedColumnName="id")
     */
    private $ticket;

    /** @price @Column(type="decimal") **/
    private $price;

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
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param mixed $ticket
     * @return EventTicket
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return EventTicket
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }



}