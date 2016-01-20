<?php

namespace Customer\Form;

use Zend\Form\Form;
 use Customer\Model\Customer;

class CustomerForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('customer');
        
        // Agrega lo campos al formulario
        $this -> add(array(
            'name' => 'idcustomer',
            'type' => 'hidden'
        ));
        
        $this -> add(array(
            'name' => 'firstname',
            'type' => 'text',
            'options' => array(
                'label' => 'First Name'
            )
        ));
        
        $this -> add(array(
            'name' => 'lastname',
            'type' => 'text',
            'options' => array(
                'label' => 'Last Name'
            )
        ));
        
        $this -> add(array(
            'name' => 'phone',
            'type' => 'text',
            'options' => array(
                'label' => 'Phone Number'
            )
        ));
        
        $this -> add(array(
            'name' => 'address',
            'type' => 'text',
            'options' => array(
                'label' => 'Address'
            )
        ));
        
        $this -> add(array(
            'name' => 'city',
            'type' => 'text',
            'options' => array(
                'label' => 'City'
            )
        ));
        
        $this -> add(array(
            'name' => 'state',
            'type' => 'text',
            'options' => array(
                'label' => 'State'
            )
        ));
        
        $this -> add(array(
            'name' => 'zipcode',
            'type' => 'text',
            'options' => array(
                'label' => 'Zip Code'
            )
        ));
        
        $this -> add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton'
            )
        ));
    }
    
    public function customValidations() {
        $firstname = $this -> data["firstname"];
        $lastname = $this -> data["lastname"];
        $phone = $this -> data["phone"];
        $address = $this -> data["address"];
        $city = $this -> data["city"];
        $state = $this -> data["state"];
        $zipcode = $this -> data["zipcode"];
        
        // Firstname is required
        if (trim($firstname) == "" ) {
            throw new \Exception("Firstname is required.");
            return false;
        }
        
        // Lastname is required
        if (trim($lastname) == "") {
            throw new \Exception("Lastname is required.");
            return false;
        }
        
        // Phone is required
        if (trim($phone) == "") {
            throw new \Exception("Phone is required.");
            return false;
        }
        
        // Phone is valid
        if (!preg_match("/^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/", $phone)) {
            throw new \Exception("Phone is invalid.");
            return false;
        }
        
        // State and zip code are required when address is not empty
        if (trim($address) != "") {
            if (trim($state) == "") {
                throw new \Exception("State is required.");
                return false;
            }
            
            if ($zipcode.trim() == "") {
                throw new \Exception("Zip Code is required.");
                return false;
            }
        }
        
        // Zip code is required when state is not empty
        if (trim($state) != "") {
            if (trim($zipcode) == "") {
                throw new \Exception("Zip Code is required.");
                return false;
            }
        }
        
        // State is required when zip code is not empty
        if (trim($zipcode) != "") {
            if (trim($state) == "") {
                throw new \Exception("State is required.");
                return false;
            }
        }
        
        // State and zip code is required when when city is not empty
        if (trim($city) != "") {
            if (trim($state) == "") {
                throw new \Exception("State is required.");
                return false;
            }
            
            if (trim($zipcode) == "") {
                throw new \Exception("Zip Code is required.");
                return false;
            }
        }
        return true;
    }
}