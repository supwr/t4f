<?php

namespace Services;

use \Entities\Show;
use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use Symfony\Component\HttpFoundation\Request;

class ShowService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createShow(\stdClass $data)
    {
        $show = new Show();
        $show->setName($data->name);
        $show->setGenre($this->em->getRepository('Entities\Genre')->findOneBy(array("id" => $data->genre)));
        $show->setVenue($this->em->getRepository('Entities\Venue')->findOneBy(array("id" => $data->venue)));
        $show->setShowDate(new \DateTime($data->event_date));
        $show->setSalesStartDate(new \DateTime($data->sales_start_date));
        $show->setActive(1);

        $this->em->persist($show);

        $this->em->flush();
        $this->em->clear();

        return $show;
    }

    public function updateShow($id, $data)
    {

        $showsQueryBuilder = $this->em->createQueryBuilder();
        $showsQueryBuilder->update('Entities\Show', 's');

        foreach ($data as $k => $v){
            $field = sprintf("s.%s", $k);
            $showsQueryBuilder->set($field, $showsQueryBuilder->expr()->literal($v));
        }

        $showsQueryBuilder->where('s.id = :id')->setParameter('id', $id);

        $showsQueryBuilder->getQuery()->execute();

    }


    public function getShows($id = null)
    {
        $photos = new ShowPhotoService($this->em);
        $showTickets = new ShowTicketService($this->em);

        $showsQuery = $this->em->createQueryBuilder()
            ->select('s.id', 's.name', 'g.name as genre_name','v.name as venue_name', 'v.id as venue_id','s.show_date', 's.sales_start_date')
            ->from('Entities\Show', 's')
            ->leftJoin('Entities\Genre', 'g', Expr\Join::WITH, 'g.id = s.genre')
            ->leftJoin('Entities\Venue', 'v', Expr\Join::WITH, 'v.id = s.venue')
            ->where('s.active = 1');

        if($id){
            $showsQuery->Andwhere('s.id = :id')->setParameter("id", $id);
        }

        $shows = $showsQuery->getQuery()->getResult();

        foreach($shows as &$s){
            $s['photos'] = $photos->getPhotoByShow($s['id']);
            $s['tickets'] = $showTickets->getShowTicketByShow($s['id']);
        }

        return $shows;
    }

    public function deleteShow($id)
    {
        if(! intval($id)){
            throw new \Exception("Oops, an error was found. Check if you're sending the right show id");
        }

        $show = $this->em->getRepository('Entities\Show')->find($id);

        if(is_null($show)){
            throw new \Exception("Show not found");
        }

        $show->setActive(0);
        $this->em->persist($show);

        $this->em->flush();
        $this->em->clear();
    }

}

?>