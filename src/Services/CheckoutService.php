<?php

namespace Services;

use \Doctrine\ORM\EntityManager;
use \Entities\Sale;
use Predis\Client;
use Symfony\Component\Config\Definition\Exception\Exception;
use Services\ShowTicketService;


class CheckoutService
{
    private $redis;
    private $em;

    public function __construct(Client $redis, EntityManager $em)
    {
        $this->redis = $redis;
        $this->em = $em;
    }

    public function cartCheckout($data)
    {
        $showTicketService = new ShowTicketService($this->em);
        $cartItems = unserialize($this->redis->get($data->customer_id));

        if(count($cartItems) == 0){
            throw new Exception("There no items in your cart");
        }

        $showTickets = $showTicketService->getAvailableShowTickets($cartItems["show_id"]);

        $availableTickets = intval($showTickets[0]["quantity"]) - intval($showTickets[0]["total_sold"]);

        if(intval($cartItems["quantity"]) > $availableTickets){
            throw new Exception(
                sprintf(
                    "Your order exceeds the availability of tickets. You ordered %d, but there are only %d available",
                    $cartItems["quantity"], $availableTickets
                )
            );
        }

        $sale = new Sale();
        $sale->setCreateTime(new \DateTime());
        $sale->setCustomer($this->em->getRepository('Entities\Show')->findOneBy(array("id" => $cartItems["show_id"])));
        $sale->setPaymentMethod($data->payment_method);
        $sale->setCreditCardId(isset($data->credit_card_id) ? $data->credit_card_id : null);
        $sale->setBilletId(isset($data->billet_id) ? $data->billet_id : null);
        $sale->setTotalPrice(floatval($cartItems["total_price"]));

        $this->em->persist($sale);

        $this->em->flush();
        $this->em->clear();
    }

}