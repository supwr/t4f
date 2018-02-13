<?php

namespace Services;

use \Entities\Show;
use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use Symfony\Component\HttpFoundation\Request;

class ShowTicketService
{

    public function createShowTicket(\stdClass $data)
    {
        $show = new Show();
        $show->setName($data->name);
        $show->setShow($this->em->getRepository('Entities\Show')->findOneBy(array("id" => $data->show)));
        $show->setQuantity($data->quantity);
        $show->setPrice($data->price);
        $show->setServiceFee($data->service_fee);
        $show->setActive(1);

        $this->em->persist($show);

        $this->em->flush();
        $this->em->clear();

        return $show;
    }

    public function getShowTicket($id = null)
    {

    }

    public function deleteShowTicket($id)
    {

    }

}