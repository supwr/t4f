<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class ShowTicketController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {

        $showTickets = $app["controllers_factory"];

        $showTickets->get('/{id}', function (Request $request, $id = null) use ($app) {
            $showTickets = $app['show.ticket.service']->getShows($id);
            return $app->json($showTickets, 200);
        });

        $showTickets->delete('/{id}', function (Request $request, $id) use ($app) {
            $app['show.ticket.service']->deleteShowTicket($id);

            return $app->json(array(), 204);
        });
    }
}