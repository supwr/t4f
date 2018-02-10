<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class VenueController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $events = $app["controllers_factory"];

        $events->get('/{id}', function (Request $request, $id = null) use ($app) {
            $events = $app['venue.service']->getVenues($id);

            return $app->json($events, 200);
        });

        $events->post('/', function (Request $request) use ($app) {
            $data = (object) $request->request->all();
            $event = $app['venue.service']->createVenue($data);

            $events = $app['venue.service']->getVenues($event->getId());

            return $app->json($events, 201);
        });

        return $events;

    }

}

?>