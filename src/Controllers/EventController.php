<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class EventController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $events = $app["controllers_factory"];

        $events->get('/{id}', function (Request $request, $id = null) use ($app) {
            $events = $app['event.service']->getEvents($id);

            return $app->json($events, 200);
        });

        $events->post('/', function (Request $request) use ($app) {
            $data = (object) $request->request->all();
            $event = $app['event.service']->createEvent($data);

            $events = $app['event.service']->getEvents($event->getId());

            return $app->json($events, 201);
        });

        $events->delete('/{id}', function (Request $request, $id) use ($app) {
            $app['event.service']->deleteEvent($id);

            return $app->json(array(), 204);
        });

        return $events;

    }

}



?>