<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class CustomerController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {

        $customers = $app["controllers_factory"];

        $customers->get('/{id}', function (Request $request, $id = null) use ($app) {
            $customers = $app['customer.service']->getCustomers($id);

            return $app->json($customers, 200);
        });

        $customers->post('/', function (Request $request) use ($app) {
            $data = (object) $request->request->all();
            $customer = $app['customer.service']->createCustomer($data);

            $customers = $app['customer.service']->getCustomers($customer->getId());

            return $app->json($customers, 201);
        });

        $customers->patch('/{id}', function (Request $request, $id) use ($app) {
            $data = (object) $request->request->all();
            $app['customer.service']->updateCustomer($id, $data);

            $show = $app['customer.service']->getCustomers($id);

            return $app->json($show, 200);
        });

        $customers->delete('/{id}', function (Request $request, $id) use ($app) {
            $app['customer.service']->deleteCustomer($id);

            return $app->json(array(), 204);
        });

        return $customers;

    }

}

?>