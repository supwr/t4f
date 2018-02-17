<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class CartController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $cart = $app["controllers_factory"];

        $cart->get('/{customer_id}', function (Request $request, $customer_id = null) use ($app) {
            $cart = $app['cart.service']->getCart($customer_id);

            return $app->json($cart, 200);
        });

        $cart->post('/', function (Request $request) use ($app) {
            $data = (object) $request->request->all();
            $app['cart.service']->addCartItem($data);

            $cart = $app['cart.service']->getCart($data->customer_id);

            return $app->json($cart, 201);
        });

        return $cart;

    }

}

?>