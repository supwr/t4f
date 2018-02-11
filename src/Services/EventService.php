<?php

namespace Services;

use \Entities\Event;
use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;

class EventService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createEvent(\stdClass $data)
    {
        $event = new Event();
        $event->setShow($this->em->getRepository('Entities\Show')->findOneBy(array("id" => $data->show)));
        $event->setVenue($this->em->getRepository('Entities\Venue')->findOneBy(array("id" => $data->venue)));
        $event->setEventDate(new \DateTime($data->event_date));
        $event->setSalesStartDate(new \DateTime($data->sales_start_date));
        $event->setActive(1);

        $this->em->persist($event);

        $this->em->flush();
        $this->em->clear();

        return $event;
    }

    public function getEvents($id)
    {
        $eventsQuery = $this->em->createQueryBuilder()
            ->select('e.id', 'v.name', 'e.event_date', 'e.sales_start_date','s.name as show_name')
            ->from('Entities\Event', 'e')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = e.show')
            ->leftJoin('Entities\Venue', 'v', Expr\Join::WITH, 'v.id = e.venue')
            ->where('e.active = 1')
            ->andWhere('e.id = :id')->setParameter("id", $id);

        $events = $eventsQuery->getQuery()->getResult();

        return $events;
    }

    public function getEventSectors($id)
    {
        $sectorsQuery = $this->em->createQueryBuilder()
            ->select('e.id', 'v.name', 's.name as show_name')
            ->from('Entities\Event', 'e')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = e.show')
            ->leftJoin('Entities\Venue', 'v', Expr\Join::WITH, 'v.id = e.venue')
            ->where('e.active = 1')
            ->andWhere('e.id = :id')->setParameter("id", $id);

        $sectors = $sectorsQuery->getQuery()->getResult();

        return $sectors;
    }

    public function getEventsByShow($show_id)
    {
        $eventsQuery = $this->em->createQueryBuilder()
            ->select('e.id', 'v.name', 'e.event_date', 'e.sales_start_date')
            ->from('Entities\Event', 'e')
            ->leftJoin('Entities\Venue', 'v', Expr\Join::WITH, 'v.id = e.venue')
            ->where('e.active = 1')
            ->andWhere('e.show = :id')->setParameter("id", $show_id);

        $events = $eventsQuery->getQuery()->getResult();

        return $events;
    }

    public function deleteEvent($id)
    {
        if(! intval($id)){
            throw new \Exception("Oops, an error was found. Check if you're sending the right event id");
        }

        $event = $this->em->getRepository('Entities\Event')->find($id);

        if(is_null($event)){
            throw new \Exception("Event not found");
        }

        $event->setActive(0);
        $this->em->persist($event);

        $this->em->flush();
        $this->em->clear();
    }

}

?>