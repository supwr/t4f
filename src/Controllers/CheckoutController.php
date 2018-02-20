<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $checkout = $app["controllers_factory"];

        $checkout->post('/', function (Request $request) use ($app) {
            $data = (object) $request->request->all();
            $app['checkout.service']->cartCheckout($data);

            $checkout = $app['checkout.service']->getCheckout($data->customer_id);

            return $app->json($checkout, 200);
        });

        return $checkout;

    }

}

?>