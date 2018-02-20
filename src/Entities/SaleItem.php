<?php

namespace Entities;

/**
 * @Entity @Table(name="sale_item")
 **/
class SaleItem
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Sale")
     * @JoinColumn(name="sale_id", referencedColumnName="id")
     */
    private $sale;

    /**
     * @ManyToOne(targetEntity="Show")
     * @JoinColumn(name="show_id", referencedColumnName="id")
     */
    private $show;

    /** @price @Column(type="decimal") **/
    private $price;

    /** @create_time @Column(type="datetime") **/
    private $create_time;

    /**
     * @return mixed
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * @param mixed $show
     * @return SaleItem
     */
    public function setShow($show)
    {
        $this->show = $show;
        return $this;
    }

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
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * @param mixed $sale
     * @return SaleItem
     */
    public function setSale($sale)
    {
        $this->sale = $sale;
        return $this;
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
     * @return CartItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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
     * @return CartItem
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * @param mixed $create_time
     * @return CartItem
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
        return $this;
    }



}