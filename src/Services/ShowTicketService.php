<?php

namespace Services;

use \Entities\Show;
use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use Entities\ShowTicket;
use Symfony\Component\HttpFoundation\Request;

class ShowTicketService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createShowTicket(\stdClass $data, $show_id)
    {
        $showTicket = new ShowTicket();
        $showTicket->setName($data->name);
        $showTicket->setShow($this->em->getRepository('Entities\Show')->findOneBy(array("id" => $show_id)));
        $showTicket->setQuantity($data->quantity);
        $showTicket->setPrice($data->price);
        $showTicket->setServiceFee($data->service_fee);
        $showTicket->setActive(1);

        $this->em->persist($showTicket);

        $this->em->flush();
        $this->em->clear();

        return $showTicket;
    }

    public function getShowTicket($id = null)
    {
        $showTicketQuery = $this->em->createQueryBuilder()
            ->select("st.id", "st.name", "s.name as show", "st.quantity", "st.price", "st.service_fee")
            ->from('Entities\ShowTicket', 'st')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = st.show')
            ->where('st.id = :id')
            ->setParameter("id", $id);

        $showTickets = $showTicketQuery->getQuery()->getResult();

        return $showTickets;
    }

    public function deleteShowTicket($show_id, $ticket_id)
    {
        if(! intval($ticket_id)){
            throw new \Exception("Oops, an error was found. Check if you're sending the right ticket id");
        }

        $showTicket = $this->em->getRepository('Entities\ShowTicket')->findOneBy(array("id" => $ticket_id, "show" => $show_id));

        if(is_null($showTicket)){
            throw new \Exception("Ticket not found");
        }

        $showTicket->setActive(0);
        $this->em->persist($showTicket);

        $this->em->flush();
        $this->em->clear();
    }

    public function getShowTicketByShow($show_id)
    {
        $showTicketQuery = $this->em->createQueryBuilder()
            ->select("st.id", "st.name", "st.quantity", "st.price", "st.service_fee")
            ->from('Entities\ShowTicket', 'st')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = st.show')
            ->where('s.id = :id')
            ->setParameter("id", $show_id);

        $showTickets = $showTicketQuery->getQuery()->getResult();

        return $showTickets;
    }

}