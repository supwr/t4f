<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class ShowController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $shows = $app["controllers_factory"];

        $shows->get('/{id}', function (Request $request, $id) use ($app) {
            $shows = $app['show.service']->getShows($id);

            return $app->json($shows, 200);
        });

        $shows->post('/', function (Request $request) use ($app) {
            $data = (object) $request->request->all();
            $show = $app['show.service']->createShow($data);

            $shows = $app['show.service']->getShows($show->getId());

            return $app->json($shows, 201);
        });

        return $shows;

    }

}



?>