<?php

namespace Entities;

/**
 * @Entity @Table(name="event")
 **/
class Event
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @artist_id @Column(type="integer") **/
    private $artist_id;    

    /** @show_id @Column(type="integer") **/
    private $show_id;

    /** @venue_id @Column(type="integer") **/
    private $venue_id;

    /** @event_date @Column(type="datetime") **/
    private $event_date;

    /** @sales_start_date @Column(type="date") **/
    private $sales_start_date;
    
    /** @name @Column(type="boolean") **/
    private $active;

}