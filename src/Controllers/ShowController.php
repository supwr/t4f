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

        $getShows = function ($id = null) use ($app){
            $shows = $app['show.service']->getShows($id);
            return $shows;
        };

        $shows->get('/', function (Request $request) use ($app, $getShows) {
            $shows = $getShows();
            return $app->json($shows, 200);
        });

        $shows->get('/{id}', function (Request $request, $id = null) use ($app, $getShows) {
            $shows = $getShows($id);
            return $app->json($shows, 200);
        });

        $shows->post('/{id}/upload', function (Request $request, $id) use ($app){
            $fileUpload = $app['show.photo.service']->uploadShowPhoto($request, $id);

            $file = $app['show.photo.service']->getShowPhoto($fileUpload->getId());
            return $app->json($file, 201);
        });

        $shows->post('/', function (Request $request) use ($app) {
            $data = (object) $request->request->all();
            $show = $app['show.service']->createShow($data);

            $shows = $app['show.service']->getShows($show->getId());

            return $app->json($shows, 201);
        });

        $shows->patch('/{id}', function (Request $request, $id) use ($app) {
            $data = (object) $request->request->all();
            $app['show.service']->updateShow($id, $data);

            $show = $app['show.service']->getShows($id);

            return $app->json($show, 200);
        });

        $shows->delete('/{id}', function (Request $request, $id) use ($app) {
            $app['show.service']->deleteShow($id);

            return $app->json(array(), 204);
        });

        $shows->post('/{id}/tickets', function (Request $request, $id) use ($app){
            $data = (object) $request->request->all();

            $ticket = $app['show.ticket.service']->createShowTicket($data, $id);
            $tickets = $app['show.ticket.service']->getShowTicket($ticket->getId());

            return $app->json($tickets, 201);
        });

        $shows->delete('/{id}/tickets/{ticket_id}', function (Request $request, $id, $ticket_id) use ($app) {
            $app['show.ticket.service']->deleteShowTicket($id, $ticket_id);

            return $app->json(array(), 204);
        });


        return $shows;

    }

}



?>