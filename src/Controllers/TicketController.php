<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class TicketController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $factory = $app["controllers_factory"];

        $factory->get("/", "Controllers\TicketController::index");
       
        return $factory;

    }

    public function index(Application $app)
    {

        return $app->json(array("message" => "Tickets endpoint."), 200);
    }

}



?>