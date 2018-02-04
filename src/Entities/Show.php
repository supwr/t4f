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
     * @ManyToOne(targetEntity="Genre")
     * @JoinColumn(name="genre_id", referencedColumnName="id")
     */
    private $genre;

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


}