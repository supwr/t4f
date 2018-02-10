<?php

namespace Services;

use \Entities\Venue;
use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;

class VenueService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createVenue(\stdClass $data)
    {
        $venue = new Venue();
        $venue->setCity($this->em->getRepository('Entities\City')->findOneBy(array("id" => $data->city)));
        $venue->setName($data->name);
        $venue->setActive(1);

        $this->em->persist($venue);

        $this->em->flush();
        $this->em->clear();

        return $venue;
    }

    public function getVenues($id)
    {
        $venuesQuery = $this->em->createQueryBuilder()
            ->select('v.id', 'v.name', 'c.name as city_name, c.id as city_id, c.uf')
            ->from('Entities\Venue', 'v')
            ->leftJoin('Entities\City', 'c', Expr\Join::WITH, 'c.id = v.city')
            ->where('v.active = 1')
            ->andWhere('c.id = :id')->setParameter("id", $id);

        $venues = $venuesQuery->getQuery()->getResult();

        return $venues;
    }
}

?>