<?php

namespace Entities;

/**
 * @Entity @Table(name="sale")
 **/
class Sale
{

    private static $card = 'card'; // para pagamento no cartão de crédito
    private static $billet = 'billet'; // para pagamento no boleto bancário

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @create_time @Column(type="datetime") **/
    private $create_time;

    /**
     * @ManyToOne(targetEntity="Customer")
     * @JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /** @payment_method @Column(type="string") **/
    private $payment_method;

    /** @credit_card_id @Column(type="integer") **/
    private $credit_card_id;

    /** @billet_id @Column(type="integer") **/
    private $billet_id;

    /** @charging_time @Column(type="datetime") **/
    private $charging_time;

    /** @total_price @Column(type="decimal") **/
    private $total_price;

    /** @cancellation_time @Column(type="datetime") **/
    private $cancellation_time;

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
    public function setCreateTime(\DateTime $create_time = null)
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

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * @param mixed $payment_method
     * @return Sale
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreditCardId()
    {
        return $this->credit_card_id;
    }

    /**
     * @param mixed $credit_card_id
     * @return Sale
     */
    public function setCreditCardId($credit_card_id = null)
    {
        $this->credit_card_id = $credit_card_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBilletId()
    {
        return $this->billet_id;
    }

    /**
     * @param mixed $billet_id
     * @return Sale
     */
    public function setBilletId($billet_id = null)
    {
        $this->billet_id = $billet_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChargingTime()
    {
        return $this->charging_time;
    }

    /**
     * @param mixed $charging_time
     * @return Sale
     */
    public function setChargingTime(\DateTime $charging_time = null)
    {
        $this->charging_time = $charging_time;
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
     * @return Sale
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCancellationTime()
    {
        return $this->cancellation_time;
    }

    /**
     * @param mixed $cancellation_time
     * @return Sale
     */
    public function setCancellationTime(\DateTime $cancellation_time = null)
    {
        $this->cancellation_time = $cancellation_time;
        return $this;
    }

}