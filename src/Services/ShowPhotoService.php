<?php

namespace Services;

use \Entities\ShowPhoto;
use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use Symfony\Component\HttpFoundation\Request;

class ShowPhotoService
{
    private $em;

    public static $IMAGES_DIR = __DIR__.'/../../web/images/';
    public static $IMAGES_WEB_PATH = null;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        self::$IMAGES_WEB_PATH =  $_SERVER['HTTP_HOST'].'/images/';
    }

    public function uploadShowPhoto(Request $request, $show)
    {
        $file = $request->files->get('photo');

        if(count($this->getPhotoByFileName($file->getClientOriginalName()))){
            throw new \Exception("There's already a file with this name. Try a different one.");
        }

        if(is_null($file)){
            throw new \Exception("No photo found");
        }

        try{
            $file->move(self::$IMAGES_DIR, $file->getClientOriginalName());
        }catch (\Exception $e){
            throw new \Exception("Ooops. An error occured while uploading image.");
        }

        $photo = new ShowPhoto();
        $photo->setFileName($file->getClientOriginalName());
        $photo->setFileSize($file->getClientSize());
        $photo->setShow($this->em->getRepository('Entities\Show')->findOneBy(array("id" => $show)));

        $this->em->persist($photo);

        $this->em->flush();
        $this->em->clear();

        return $photo;
    }

    function getShowPhoto($id)
    {
        $showPhotoQuery = $this->em->createQueryBuilder()
            ->select("sp.id", "sp.file_name", "sp.file_size", "CONCAT(:images_dir, sp.file_name) as url", "s.name as show_name")
            ->from('Entities\ShowPhoto', 'sp')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = sp.show')
            ->where('s.active = 1')
            ->andWhere('sp.id = :id')
            ->setParameter("id", $id)
            ->setParameter("images_dir", self::$IMAGES_WEB_PATH);

        $showPhoto = $showPhotoQuery->getQuery()->getResult();

        return $showPhoto;
    }

    public function getPhotoByShow($show_id)
    {
        $showPhotoQuery = $this->em->createQueryBuilder()
            ->select("sp.id", "sp.file_name", "sp.file_size", "CONCAT(:images_dir, sp.file_name) as url", "s.name as show_name")
            ->from('Entities\ShowPhoto', 'sp')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = sp.show')
            ->where('s.id = :id')
            ->setParameter("id", $show_id)
            ->setParameter("images_dir", self::$IMAGES_WEB_PATH);

        $showPhoto = $showPhotoQuery->getQuery()->getResult();

        return $showPhoto;
    }

    public function getPhotoByFileName($file_name)
    {
        $showPhotoQuery = $this->em->createQueryBuilder()
            ->select("sp.id", "sp.file_name", "sp.file_size", "CONCAT(:images_dir, sp.file_name) as url", "s.name as show_name")
            ->from('Entities\ShowPhoto', 'sp')
            ->leftJoin('Entities\Show', 's', Expr\Join::WITH, 's.id = sp.show')
            ->where('sp.file_name = :file_name')
            ->setParameter("file_name", $file_name)
            ->setParameter("images_dir", self::$IMAGES_WEB_PATH);

        $showPhoto = $showPhotoQuery->getQuery()->getResult();

        return $showPhoto;
    }

    public function deleteShowPhoto($id)
    {
        if(! intval($id)){
            throw new \Exception("Oops, an error was found. Check if you're sending the right photo id.");
        }

        $showPhoto = $this->em->getRepository('Entities\ShowPhoto')->find($id);

        if(is_null($showPhoto)){
            throw new \Exception("Photo not found");
        }

        $file_name = $showPhoto->getFileName();

        $this->em->remove($showPhoto);
        $this->em->flush();
        $this->em->clear();

        unlink(self::$IMAGES_DIR.$file_name);
    }
}

?>