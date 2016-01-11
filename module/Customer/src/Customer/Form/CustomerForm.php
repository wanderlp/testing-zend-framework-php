<?php

namespace Customer\Form;

use Zend\Form\Form;

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
}