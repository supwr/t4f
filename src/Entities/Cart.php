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

    /** @customer_id @Column(type="integer") **/
    private $customer_id;

}