<?php

namespace Services;

use \Doctrine\ORM\EntityManager;
use Predis\Client;
use Symfony\Component\Config\Definition\Exception\Exception;


class CartService
{
    private $redis;
    private $em;

    public function __construct(Client $redis, EntityManager $em)
    {
        $this->redis = $redis;
        $this->em = $em;
    }

    public function cartExists($cartId){
        return $this->redis->exists($cartId);
    }

    public function createCart($cartId){
        $cartItems = array();
        $this->redis->set($cartId, serialize($cartItems));
    }

    public function showTicketExists($cartItems, $show_id){
        foreach($cartItems as $k => $v){
            if($k == 'show_id' && $v == $show_id){
                return true;
            }
        }

        return false;
    }

    public function addCartItem(\stdClass $data)
    {
        $cartItem = $this->em->getRepository("Entities\ShowTicket")->find($data->ticket_id);
        $data->single_price = $cartItem->getPrice();
        $data->total_price = $cartItem->getPrice() * $data->quantity;

        if(!$this->cartExists($data->customer_id)){
            $this->redis->set($data->customer_id, serialize((array) $data));
            return $this->redis->get($data->customer_id);
        }

        if(!$this->showTicketExists(unserialize($this->redis->get($data->customer_id)), $data->show_id)){
            throw new Exception("The cart only accepts tickets for the same show.");
        }

        $cartItems = unserialize($this->redis->get($data->customer_id));
        $cartItems["quantity"] = intval($cartItems["quantity"]) + intval($data->quantity);
        $cartItems["total_price"] = floatval($cartItems["total_price"]) + $data->total_price;

        $this->redis->set($data->customer_id, serialize($cartItems));

        return $this->redis->get($data->customer_id);
    }

    public function subCartItem(\stdClass $data)
    {
        $cartItems = unserialize($this->redis->get($data->customer_id));

        if(intval($cartItems["quantity"]) - intval($data->quantity) <= 0){
            $this->deleteCart($data);
            return ;
        }

        $cartItems["quantity"] = intval($cartItems["quantity"]) - intval($data->quantity);
        $cartItems["total_price"] = floatval($cartItems["total_price"]) - (floatval($cartItems["single_price"]) * $data->quantity);

        $this->redis->set($data->customer_id, serialize($cartItems));

    }

    public function deleteCart(\stdClass $data){
        $this->redis->del($data->customer_id);
    }

    public function getCart($customer_id)
    {
        $cart = $this->redis->get($customer_id);
        return unserialize($cart);
    }


}