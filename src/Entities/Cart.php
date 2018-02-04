<?php

namespace Entities;

/**
 * @Entity @Table(name="cart")
 **/
class Cart
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @create_time @Column(type="datetime") **/
    private $create_time;

    /**
     * @ManyToOne(targetEntity="Customer")
     * @JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

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
    public function getCreateTime()
    {
        return $this->create_time;
    }

    /**
     * @param mixed $create_time
     * @return Cart
     */
    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     * @return Cart
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

}