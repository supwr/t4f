<?php

namespace Entities;

/**
 * @Entity @Table(name="event_ticket")
 **/
class EventTicket
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @ticket_id @Column(type="string") **/
    private $ticket_id;

    /** @price @Column(type="decimal") **/
    private $price;

}