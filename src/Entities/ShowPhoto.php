<?php

namespace Entities;

/**
 * @Entity @Table(name="show_photo")
 **/
class ShowPhoto
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @file_name @Column(type="string") **/
    private $file_name;

    /** @file_size @Column(type="bigint") **/
    private $file_size;

    /**
     * @ManyToOne(targetEntity="Show")
     * @JoinColumn(name="show_id", referencedColumnName="id")
     */
    private $show;

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
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * @param mixed $file_name
     * @return ShowPhoto
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->file_size;
    }

    /**
     * @param mixed $file_size
     * @return ShowPhoto
     */
    public function setFileSize($file_size)
    {
        $this->file_size = $file_size;
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
     * @return ShowPhoto
     */
    public function setShow($show)
    {
        $this->show = $show;
        return $this;
    }

}