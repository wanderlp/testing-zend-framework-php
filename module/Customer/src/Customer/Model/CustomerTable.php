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
    
    public function searchCustomer($customer)
    {
        $id = (int) $customer -> idcustomer;
        $firstname = str_replace(' ', '%', $customer -> firstname);
        $lastname = str_replace(' ', '%', $customer -> lastname);
        $phone = $customer -> phone;
        $address = str_replace(' ', '%', $customer -> address);
        $city = str_replace(' ', '%', $customer -> city);
        $state = str_replace(' ', '%', $customer -> state);
        $zipcode = str_replace(' ', '%', $customer -> zipcode);
        $where = "1 = 1";
        if ($customer -> idcustomer != 0)
            $where = $where." and idcustomer = $id";
        if ($customer -> firstname != "")
            $where = $where." and firstname like '%$firstname%'";
        if ($customer -> lastname != "")
            $where = $where." and lastname like '%$lastname%'";
        if ($customer -> phone != "")
            $where = $where." and phone = '$phone'";
        if ($customer -> address != "")
            $where = $where." and address like '%$address%'";
        if ($customer -> city != "")
            $where = $where." and city like '%$city%'";
        if ($customer -> state != "")
            $where = $where." and state like '%$state%'";
        if ($customer -> zipcode != "")
            $where = $where." and zipcode like '%$zipcode%'";
        $resultSet = $this -> tableGateway -> select($where);
        return $resultSet;
    }
}