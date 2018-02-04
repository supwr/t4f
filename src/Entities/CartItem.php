<?php

namespace Entities;

/**
 * @Entity @Table(name="cart_item")
 **/
class CartItem
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /**
     * @ManyToOne(targetEntity="Cart")
     * @JoinColumn(name="cart_id", referencedColumnName="id")
     */
    private $cart;

    /** @unity_price @Column(type="decimal") **/
    private $unity_price;

    /** @total_price @Column(type="decimal") **/
    private $total_price;

    /** @quantity @Column(type="integer") **/
    private $quantity;

    /** @create_time @Column(type="datetime") **/
    private $create_time;

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
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param mixed $cart
     * @return CartItem
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnityPrice()
    {
        return $this->unity_price;
    }

    /**
     * @param mixed $unity_price
     * @return CartItem
     */
    public function setUnityPrice($unity_price)
    {
        $this->unity_price = $unity_price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * @param mixed $total_price
     * @return CartItem
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
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