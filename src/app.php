<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
use Services\ShowService;
use Services\VenueService;
use Services\ShowPhotoService;
use Services\ShowTicketService;
use Services\CustomerService;
use Services\CartService;
use Predis\Client;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app['redis.service'] = function() {
    $client = new Client();
    return $client;
};

$app['cart.service'] = function($app) {
    return new CartService($app['redis.service'], $app["orm.em"]);
};

$app['show.service'] = function ($app) {
    return new ShowService($app["orm.em"]);
};

$app['show.photo.service'] = function ($app) {
    return new ShowPhotoService($app["orm.em"]);
};

$app['show.ticket.service'] = function ($app) {
    return new ShowTicketService($app["orm.em"]);
};

$app['venue.service'] = function ($app) {
    return new VenueService($app["orm.em"]);
};

$app['customer.service'] = function ($app) {
    return new CustomerService($app["orm.em"]);
};

$app->register(new Silex\Provider\DoctrineServiceProvider, array(
    'db.options' => array(
        'dbname' => 't4f',
        'user' => 'root',
        'password' => 'root',
        'host' => 'localhost',
        'port' => 3306,
        'charset' => 'utf8',
        'driver' => 'pdo_mysql'
    )
));

$app->register(new DoctrineOrmServiceProvider, array(
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'type' => 'annotation',
                'namespace' => 'Entities',
                'path' => __DIR__.'/Entities',
            )
        )
    )
));

$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v6',
    'assets.named_packages' => array(
        'assets' => array('base_path' => '/web/assets'),
    ),
));


$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});

return $app;
