<?php

namespace Entities;

/**
 * @Entity @Table(name="shows")
 **/
class Show
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @name @Column(type="string") **/
    private $name;

    /**
     * @ManyToOne(targetEntity="Artist")
     * @JoinColumn(name="artist_id", referencedColumnName="id")
     */
    private $artist;

    /**
     * @ManyToOne(targetEntity="Genre")
     * @JoinColumn(name="genre_id", referencedColumnName="id")
     */
    private $genre;

    /**
     * @ManyToOne(targetEntity="Venue")
     * @JoinColumn(name="venue_id", referencedColumnName="id")
     */
    private $venue;

    /** @show_date @Column(type="datetime") **/
    private $show_date;

    /** @sales_start_date @Column(type="date") **/
    private $sales_start_date;

    /** @active @Column(type="boolean") **/
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
     * @return Show
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return Show
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
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
     * @return Show
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShowDate()
    {
        return $this->show_date;
    }

    /**
     * @param mixed $show_date
     * @return Show
     */
    public function setShowDate($show_date)
    {
        $this->show_date = $show_date;
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
     * @return Show
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
     * @return Show
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     * @return Show
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
        return $this;
    }

}