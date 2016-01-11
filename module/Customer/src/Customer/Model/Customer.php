<?php
/*
 * Modelo para la tabla: customer
 * Contiene la referencia a cada campo de la tabla
 *
 */

namespace Customer\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Customer implements InputFilterAwareInterface {
    public $idcustomer;
    public $firstname;
    public $lastname;
    public $phone;
    public $address;
    public $city;
    public $state;
    public $zipcode;
    protected $inputFilter;
    
    public function exchangeArray($data)
    {
        $this -> idcustomer = (!empty($data['idcustomer'])) ? $data['idcustomer'] : null;
        $this -> firstname  = (!empty($data['firstname'])) ? $data['firstname'] : null;
        $this -> lastname   = (!empty($data['lastname'])) ? $data['lastname'] : null;
        $this -> phone      = (!empty($data['phone'])) ? $data['phone'] : null;
        $this -> address    = (!empty($data['address'])) ? $data['address'] : null;
        $this -> city       = (!empty($data['city'])) ? $data['city'] : null;
        $this -> state      = (!empty($data['state'])) ? $data['state'] : null;
        $this -> zipcode    = (!empty($data['zipcode'])) ? $data['zipcode'] : null;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if (!$this -> inputFilter)
        {
            $inputFilter = new InputFilter();
            
            $inputFilter -> add(array(
                'id'       => 'idcustomer',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int')
                )
            ));
            
            $inputFilter -> add(array(
                'id'       => 'firstname',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100
                        )
                    )
                )
            ));
            
            $inputFilter -> add(array(
                'id'       => 'lastname',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100
                        )
                    )
                )
            ));
            
            $inputFilter -> add(array(
                'id'       => 'phone',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 15
                        )
                    )
                )
            ));
            
            $inputFilter -> add(array(
                'id'       => 'address',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255
                        )
                    )
                )
            ));
            
            $inputFilter -> add(array(
                'id'       => 'city',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 50
                        )
                    )
                )
            ));
            
            $inputFilter -> add(array(
                'id'       => 'zipcope',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int')
                )
            ));
            
            $this->inputFilter = $inputFilter;
        }
        return $this -> inputFilter;
    }
}