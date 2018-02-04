<?php

namespace Entities;

/**
 * @Entity @Table(name="cart_item")
 **/
class CartItem
{

    /** @id @Column(type="integer") @GeneratedValue **/
    private $id;

    /** @name @Column(type="integer") **/
    private $cart_id;

    /** @price @Column(type="decimal") **/
    private $price;

    /** @create_time @Column(type="datetime") **/
    private $create_time;


}