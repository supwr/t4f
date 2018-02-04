<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class HomeController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $factory = $app["controllers_factory"];

        $factory->get("/", "Controllers\HomeController::index");
       
        return $factory;

    }

    public function index(Application $app)
    {

        $artists = $app['orm.em']->getRepository("Entities\Artist")->findBy(array(),array("name" => "ASC"));
        $return = array();

        foreach($artists as $artist){
            array_push($return, array("name" => $artist->getName(), "genre" => $artist->getGenre()->getName()));
        }

        return $app->json(array("artistas" => $return), 200);
    }

}



?>