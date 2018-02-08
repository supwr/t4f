<?php

namespace Services;

use \Entities\Show;
use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__\stdClass;

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
        $show->setActive(1);

        $this->em->persist($show);

        $this->em->flush();
        $this->em->clear();

        return $show;
    }

    public function getShows($id = null)
    {
        $showsQuery = $this->em->createQueryBuilder()
            ->select('s.id', 's.name', 'g.name as genre_name')
            ->from('Entities\Show', 's')
            ->leftJoin('Entities\Genre', 'g', Expr\Join::WITH, 'g.id = s.genre')
            ->where('s.active = 1');

        if($id){
            $showsQuery->Andwhere('s.id = :id')->setParameter("id", $id);
        }

        $shows = $showsQuery->getQuery()->getResult();

        return $shows;
    }

}

?>