<?php

namespace Services;

use \Entities\Customer;
use \Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;

class CustomerService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createCustomer(\stdClass $data)
    {
        $customer = new Customer();
        $customer->setFirstName($data->first_name);
        $customer->setLastName($data->last_name);
        $customer->setEmail($data->email);
        $customer->setActive(1);

        $this->em->persist($customer);

        $this->em->flush();
        $this->em->clear();

        return $customer;
    }

    public function getCustomers($id)
    {
        $customersQuery = $this->em->createQueryBuilder()
            ->select('c.id', 'c.first_name', 'c.last_name, c.email')
            ->from('Entities\Customer', 'c')
            ->where('c.active = 1')
            ->andWhere('c.id = :id')->setParameter("id", $id);

        $customers = $customersQuery->getQuery()->getResult();

        return $customers;
    }

    public function updateCustomer($id, $data)
    {
        $customersQueryBuilder = $this->em->createQueryBuilder();
        $customersQueryBuilder->update('Entities\Customer', 'c');

        foreach ($data as $k => $v){
            $field = sprintf("c.%s", $k);
            $customersQueryBuilder->set($field, $customersQueryBuilder->expr()->literal($v));
        }

        $customersQueryBuilder->where('c.id = :id')->setParameter('id', $id);

        $customersQueryBuilder->getQuery()->execute();
    }

    public function deleteCustomer($id)
    {
        if(! intval($id)){
            throw new \Exception("Oops, an error was found. Check if you're sending the right customer id");
        }

        $customer = $this->em->getRepository('Entities\Customer')->find($id);

        if(is_null($customer)){
            throw new \Exception("Show not found");
        }

        $customer->setActive(0);
        $this->em->persist($customer);

        $this->em->flush();
        $this->em->clear();
    }
}