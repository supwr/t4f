<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class ShowController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $factory = $app["controllers_factory"];

        $factory->get("/", "Controllers\ShowController::index");
        $factory->post("/", "Controllers\ShowController::index");
       
        return $factory;

    }

    public function index(Application $app)
    {
        $shows = $app['show']->getShows();

        return $app->json(array("shows" => $shows), 200);
    }

    public function post(Application $app)
    {
        return ;
    }

}



?>