<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));


// Controllers
$app->mount('/shows', new Controllers\ShowController());
$app->mount('/tickets', new Controllers\TicketController());
$app->mount('/events', new Controllers\EventController());
$app->mount('/venues', new Controllers\VenueController());

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    $error = array("msg" => $e->getMessage(), 'status' => $code);
    return $app->json($error, $code);
});
