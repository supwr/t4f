<?php

namespace Services;

use \Doctrine\ORM\EntityManager;
use Predis\Client;

class CartService
{
    private $redis;

    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    public function addCartItem(\stdClass $data)
    {
        $this->redis->exists($data->customer_id);
        $this->redis->append($data->customer_id, serialize($data));

        return $this->redis->get($data->customer_id);
    }

    public function getCart($customer_id)
    {
        $cart = $this->redis->get($customer_id);
        return unserialize($cart);
    }


}