<?php

namespace Services;

use \Entities\Show as ShowEntity;
use Doctrine\ORM\Query\Expr;

class Show
{
    private $em;
    private $name;
    private $genre;
    private $active;


    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function createShow()
    {
        $show = new ShowEntity();
        $show->setName($this->getName());
        $show->setGenre($this->em->getRepository('Entities\Genre')->findOneBy(array("id" => $this->getGenre())));

        $this->em->persist($show);

        $this->em->flush();
        $this->em->clear();
    }

    public function getShows($id = null)
    {
        $showsQuery = $this->em->createQueryBuilder()
            ->select('s.id', 's.name', 'g.name as genre_name')
            ->from('Entities\Show', 's')
            ->leftJoin('Entities\Genre', 'g', Expr\Join::WITH, 'g.id = s.genre')
            ->where('s.active = 1');

        if($id){
            $showsQuery->Andwhere('s.id = :id')->setParameter(0, $id);
        }

        $shows = $showsQuery->getQuery()->getResult();

        return $shows;

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Show
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return Show
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return Show
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

}

?>