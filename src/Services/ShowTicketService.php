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

    public function createShowTicket($show_id, \stdClass $data)
    {
        $showTicket = new ShowTicket();
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

    public function updateShowTicket($show_id, $ticket_id, $data)
    {
        $showsQueryBuilder = $this->em->createQueryBuilder();
        $showsQueryBuilder->update('Entities\ShowTicket', 'st');

        foreach ($data as $k => $v){
            $field = sprintf("st.%s", $k);
            $showsQueryBuilder->set($field, $showsQueryBuilder->expr()->literal($v));
        }

        $showsQueryBuilder->where('st.id = :ticket_id')
            ->setParameter('ticket_id', $ticket_id)
            ->andWhere('st.show = :show_id')
            ->setParameter('show_id', $show_id);

        $showsQueryBuilder->getQuery()->execute();
    }

    public function getShowTicket($id = null)
    {
        $showTicketQuery = $this->em->createQueryBuilder()
            ->select("st.id", "s.name as show", "st.quantity", "st.price", "st.service_fee")
            ->from('Entities\ShowTicket', 'st')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = st.show')
            ->where('st.id = :id')
            ->setParameter("id", $id);

        $showTickets = $showTicketQuery->getQuery()->getResult();

        return $showTickets;
    }

    public function getAvailableShowTickets($show_id)
    {
        $availableTicketsQuery = $this->em->createQueryBuilder()
            ->select("st.id", "st.quantity", "count(si.id) as total_sold")
            ->from('Entities\ShowTicket', 'st')
            ->leftJoin('Entities\SaleItem', 'si', Expr\Join::WITH, 'si.show = st.show')
            ->where('st.show = :id')
            ->groupBy("st.show")
            ->setParameter("id", $show_id);

        $availableTickets = $availableTicketsQuery->getQuery()->getResult();

        return $availableTickets;
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
            ->select("st.id", "st.quantity", "st.price", "st.service_fee")
            ->from('Entities\ShowTicket', 'st')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = st.show')
            ->where('s.id = :id')
            ->setParameter("id", $show_id);

        $showTickets = $showTicketQuery->getQuery()->getResult();

        return $showTickets;
    }

}