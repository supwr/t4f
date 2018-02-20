<?php

namespace Entities;

/**
 * @Entity @Table(name="show_ticket")
 **/
class ShowTicket
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Show")
     * @JoinColumn(name="show_id", referencedColumnName="id")
     */
    private $show;

    /** @quantity @Column(type="integer") **/
    private $quantity;

    /** @price @Column(type="float", precision=10, scale=2) **/
    private $price;

    /** @service_fee @Column(type="float", precision=10, scale=2) **/
    private $service_fee;

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
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return ShowTicket
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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
     * @return ShowTicket
     */
    public function setShow($show)
    {
        $this->show = $show;
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
     * @return ShowTicket
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiceFee()
    {
        return $this->service_fee;
    }

    /**
     * @param mixed $service_fee
     * @return ShowTicket
     */
    public function setServiceFee($service_fee)
    {
        $this->service_fee = $service_fee;
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
     * @return Ticket
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

}