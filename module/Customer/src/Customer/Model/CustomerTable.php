<?php

namespace Customer\Model;

use Zend\Db\TableGateway\TableGateway;

class CustomerTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this -> tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {
        $resultSet = $this -> tableGateway -> select();
        return $resultSet;
    }

    public function getCustomer($id)
    {
        $id  = (int) $id;
        $rowset = $this -> tableGateway -> select(array('idcustomer' => $id));
        $row = $rowset -> current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveCustomer($id, Customer $customer)
    {
        $data = array(
            'firstname'  => $customer -> firstname,
            'lastname'   => $customer -> lastname,
            'phone'      => $customer -> phone,
            'address'    => $customer -> address,
            'city'       => $customer -> city,
            'state'      => $customer -> state,
            'zipcode'    => $customer -> zipcode
        );

        $id = (int) $id;
        if ($id == 0)
        {
            $this -> tableGateway -> insert($data);
        }
        else
        {
            if ($this -> getCustomer($id))
            {
                $this -> tableGateway -> update($data, array('idcustomer' => $id));
            }
            else
            {
                throw new \Exception('Customer id does not exist');
            }
        }
    }

    public function deleteCustomer($id)
    {
        $this -> tableGateway -> delete(array('idcustomer' => (int) $id));
    }
    
    public function searchCustomer()
    {
        
    }
}