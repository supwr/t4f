<?php

namespace Controllers;

use Entities\Country;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Services\ExportCSVFile;

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

        return $app->json(array("message" => "Home endpoint."), 200);
    }

}



?>